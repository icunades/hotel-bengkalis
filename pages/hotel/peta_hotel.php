<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Hotel</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
        .action-buttons {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
        .action-buttons button {
            margin: 0 5px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .custom-alert {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .custom-alert-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        .custom-alert h2 {
            margin-top: 0;
            color: #333;
        }
        .custom-alert p {
            margin: 10px 0;
            color: #666;
        }
        .custom-alert-actions button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            font-size: 16px;
        }
        .custom-alert-actions button:hover {
            background-color: #0056b3;
        }
        .action-buttons button {
        margin: 0 5px;
        background: linear-gradient(135deg, #4caf50, #81c784);
        border: none;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .action-buttons button:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .action-buttons button:active {
        transform: scale(0.98);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .action-buttons button.reset {
        background: linear-gradient(135deg, #f44336, #e57373);
    }

    .action-buttons button.continue {
        background: linear-gradient(135deg, #2196f3, #64b5f6);
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Peta Lokasi Hotel</h1>
        <div id="map"></div>
        <div class="action-buttons" id="action-buttons">
            <button onclick="finishRoute()">Selesai</button>
            <!-- <button onclick="continueProcess()">Lanjutkan</button> -->
            <button onclick="resetMap()">Reset</button>
        </div>
    </div>
    <div id="custom-alert" class="custom-alert">
        <div class="custom-alert-content">
            <h2 id="alert-title">Alert</h2>
            <p id="alert-message">Pesan akan muncul di sini.</p>
            <div class="custom-alert-actions">
                <button onclick="closeAlert()">Tutup</button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <script>
        const map = L.map('map').setView([1.4742055, 102.1073642], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 30,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        let selectedMarkers = [];
        let routingControl = null;
        let allMarkers = [];
        let selectedHotelNames = [];

        fetch('api/input_lokasi.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(hotel => {
                    const marker = L.marker([hotel.latitude, hotel.longitude]).addTo(map);
                    marker.bindPopup(`<b>${hotel.name}</b><br>${hotel.kategori}`);
                    allMarkers.push({ marker, name: hotel.name });

                    marker.on('click', function() {
                        const latLng = marker.getLatLng();

                        if (!selectedMarkers.some(m => m.lat === latLng.lat && m.lng === latLng.lng)) {
                            selectedMarkers.push(latLng);
                            selectedHotelNames.push(hotel.name);

                            if (selectedMarkers.length >= 2) {
                                drawRoute(selectedMarkers);
                                showActionButtons();
                            }

                            if (selectedMarkers.length === allMarkers.length) {
                                document.getElementById('action-buttons').style.display = 'block';
                            }
                        }
                    });
                });
            })
            .catch(error => console.error('Error fetching hotel data:', error));

        function drawRoute(selectedMarkers) {
            if (routingControl) {
                map.removeControl(routingControl);
            }

            routingControl = L.Routing.control({
                waypoints: selectedMarkers,
                routeWhileDragging: true,
                lineOptions: {
                    styles: [{ color: 'blue', weight: 4 }]
                },
                show: false
            }).addTo(map);

            routingControl.on('routesfound', function(e) {
                const routes = e.routes;
                const totalDistance = routes[0].summary.totalDistance;
                
                const lastMarker = selectedMarkers[selectedMarkers.length - 1];
                L.popup()
                    .setLatLng(lastMarker)
                    .setContent(`Total jarak rute: ${(totalDistance / 1000).toFixed(2)} km`)
                    .openOn(map);
            });
        }

        function finishRoute() {
            if (selectedMarkers.length > 1) {
                const optimizedMarkers = optimizeRoute(selectedMarkers);
                drawRoute(optimizedMarkers);

                // Cari titik terdekat 
                let minDistance = Infinity;
                let closestPoint = null;

                for (let i = 0; i < optimizedMarkers.length - 1; i++) {
                    const distance = optimizedMarkers[i].distanceTo(optimizedMarkers[i + 1]);
                    if (distance < minDistance) {
                        minDistance = distance;
                        closestPoint = selectedHotelNames[i + 1];
                    }
                }

                // Alert 
                const pointNames = selectedHotelNames.join(' -> ');
                const totalDistance = calculateRouteDistance(optimizedMarkers);
               showAlert(
                    'Rute Terpilih',
                    `Anda telah memilih: ${pointNames}<br>` +
                    `Jarak terdekat antara dua titik adalah: ${closestPoint} dengan jarak ${(minDistance / 1000).toFixed(2)} km<br>` 
                    // `Total jarak rute: ${(totalDistance / 1000).toFixed(2)} km`
                );
            } else {
                showAlert('Peringatan', 'Pilih minimal dua lokasi untuk menghitung rute.');
            }
        }
        function showAlert(title, message) {
            document.getElementById('alert-title').innerText = title;
            document.getElementById('alert-message').innerHTML = message;
            document.getElementById('custom-alert').style.display = 'flex';
        }

        function closeAlert() {
            document.getElementById('custom-alert').style.display = 'none';
        }

        function optimizeRoute(markers) {
            return markers;
        }

        function calculateRouteDistance(route) {
            let distance = 0;
            for (let i = 0; i < route.length - 1; i++) {
                distance += route[i].distanceTo(route[i + 1]);
            }
            return distance;
        }

        function showActionButtons() {
            const actionButtons = document.getElementById('action-buttons');
            actionButtons.style.display = 'block';
        }

        function continueProcess() {
            showAlert('Informasi', 'Anda memilih untuk melanjutkan ke proses berikutnya.');
        }

        // Implementasikan algoritma A*
        function aStar(start, goal, points) { 
            const openSet = [start]; 
            const cameFrom = new Map(); 
            const gScore = new Map(points.map(p => [p, Infinity])); 
            const fScore = new Map(points.map(p => [p, Infinity])); 

            gScore.set(start, 0);
            fScore.set(start, heuristic(start, goal)); 

            while (openSet.length > 0) { 
            let current = openSet.reduce((a, b) => (fScore.get(a) < fScore.get(b) ? a : b)); 
            
            if (current.equals(goal)) { 
                return reconstructPath(cameFrom, current); // Mengembalikan rute dari start ke goal 
            }

            openSet.splice(openSet.indexOf(current), 1); 

            for (let neighbor of getNeighbors(current, points)) { 
                const tentativeGScore = gScore.get(current) + current.distanceTo(neighbor); // Menghitung gScore sementara dari start ke neighbor melalui current

                if (tentativeGScore < gScore.get(neighbor)) { 
                    cameFrom.set(neighbor, current); 
                    gScore.set(neighbor, tentativeGScore); 
                    fScore.set(neighbor, gScore.get(neighbor) + heuristic(neighbor, goal)); 

                    if (!openSet.includes(neighbor)) { 
                        openSet.push(neighbor); 
                    }
                }
            }
        }

    return [];
}

        function heuristic(pointA, pointB) {
            return pointA.distanceTo(pointB);
        }

        function getNeighbors(point, points) {
            return points.filter(p => !p.equals(point));
        }

        function reconstructPath(cameFrom, current) {
            const totalPath = [current];
            while (cameFrom.has(current)) {
                current = cameFrom.get(current);
                totalPath.unshift(current);
            }
            return totalPath;
        }

        function optimizeRoute(markers) {
            if (markers.length < 2) return markers;
            return aStar(markers[0], markers[markers.length - 1], markers);
        }

        function calculateRouteDistance(route) {
            let distance = 0;
            for (let i = 0; i < route.length - 1; i++) {
                distance += route[i].distanceTo(route[i + 1]);
            }
            return distance;
        }

        function showActionButtons() {
            const actionButtons = document.getElementById('action-buttons');
            actionButtons.style.display = 'block';
        }

        function continueProcess() {
            alert('Anda memilih untuk melanjutkan ke proses berikutnya.');
            document.getElementById('action-buttons').style.display = 'none';
        }

        function resetMap() {
            if (routingControl) {
                map.removeControl(routingControl);
                routingControl = null;
            }
            selectedMarkers = [];
            selectedHotelNames = [];
            document.getElementById('action-buttons').style.display = 'none';
        }
    </script>
</body>
</html>
