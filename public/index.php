<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PHP Project</title>
    <link href="../dist/output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4bbba015bc.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.0/dist/chart.min.js"></script>
    <link rel="icon" href="../media/img/favicon.ico" type="image/x-icon">
    <style>
        /* Hide the sidebar by default on mobile */
        .sidebar-mobile {
            display: none;
        }

        /* Show the sidebar on mobile when active */
        .sidebar-mobile.active {
            display: block;
        }

        /* CSS for chart container */
        #chartContainer {
            width: 100%;
            height: 300px;
        }

        #myChart {
            width: 100% !important;
            height: 100% !important;
        }

        /* CSS for search modal */
        #searchModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        #searchModalContent {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #searchModal input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .search-button {
            cursor: pointer;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .sidebar-mobile {
                display: none; /* Hide by default */
            }

            .content {
                margin-left: 0;
            }
        }

        @media (min-width: 769px) {
            .sidebar {
                display: block;
            }

            .sidebar-mobile {
                display: none;
            }
        }
    </style>
</head>

<body class="flex h-screen bg-gray-100 dark:bg-slate-700 overflow-hidden transition-colors duration-500">
    <!-- Sidebar for large screens -->
    <div class="sidebar w-64 bg-white text-gray-600 dark:bg-slate-900 dark:text-gray-400 lg:block flex-shrink-0">
        <div class="p-4">
            <h2 class="text-2xl font-bold dark:text-white">Dashboard</h2>
        </div>
        <ul>
            <li class="px-4 py-2 hover:bg-slate-600 hover:text-white active:bg-gray-600 dark:text-white transition-all"><a href="#" class="active">Dashboard</a></li>
            <li class="px-4 py-2 hover:bg-slate-600 hover:text-white dark:text-white transition-all"><a href="#">Profile</a></li>
            <li class="px-4 py-2 hover:bg-slate-600 hover:text-white dark:text-white transition-all"><a href="#">Settings</a></li>
        </ul>
    </div>

    <!-- Sidebar for mobile screens -->
    <div id="sidebarMobile" class="sidebar-mobile fixed top-0 left-0 w-64 bg-white text-gray-600 dark:bg-slate-900 dark:text-gray-400 lg:hidden">
        <div class="p-4">
            <h2 class="text-2xl font-bold dark:text-white">Dashboard</h2>
        </div>
        <ul>
            <li class="px-4 py-2 hover:bg-slate-600 hover:text-white active:bg-gray-600 dark:text-white transition-all"><a href="#" class="active">Dashboard</a></li>
            <li class="px-4 py-2 hover:bg-slate-600 hover:text-white dark:text-white transition-all"><a href="#">Profile</a></li>
            <li class="px-4 py-2 hover:bg-slate-600 hover:text-white dark:text-white transition-all"><a href="#">Settings</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col content">
        <!-- Navbar -->
        <div class="bg-white shadow-md p-4 flex justify-between items-center dark:bg-slate-700 dark:text-gray-200">
            <button class="lg:hidden" id="menu-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <div class="text-gray-700 flex gap-4 dark:text-gray-400">
                <div class="relative">
                    <button id="search-button" class="px-3 py-2.5 rounded-lg border-2 border-gray-700 dark:border-gray-400 hover:bg-gray-700 hover:shadow-2xl group transition-all" title="Search">
                        <i class="fa-solid fa-search fa-lg"></i>
                    </button>
                    <div id="searchModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center">
                        <div id="searchModalContent" class="bg-white p-6 rounded-lg shadow-lg">
                            <input type="text" id="searchInput" placeholder="Search Query">
                        </div>
                    </div>
                </div>

                <div id="theme-toggle" class="px-3 py-2.5 rounded-full border-2 border-gray-700 dark:border-gray-400 hover:bg-gray-700 hover:shadow-2xl group transition-colors" title="Light / Dark Mode">
                    <i class="fa-solid fa-sun fa-lg w-full group-hover:text-white"></i>
                </div>
                <div class="px-3.5 py-2.5 rounded-full border-2 border-gray-700 dark:border-gray-400 hover:bg-gray-700 hover:shadow-2xl group transition-colors" title="Notification">
                    <i class="fa-solid fa-bell fa-lg w-full group-hover:text-white"></i>
                </div>
                <div class="px-3.5 py-2.5 rounded-full border-2 border-gray-700 dark:border-gray-400 hover:bg-gray-700 hover:shadow-2xl group transition-colors" title="Account">
                    <i class="fa-solid fa-user fa-lg w-full group-hover:text-white"></i>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-4 flex-1 overflow-auto dark:bg-slate-800 dark:text-white">
            <h2 class="text-xl font-bold mb-4">Activity</h2>

            <!-- Cards Container -->
            <div class="flex flex-wrap -mx-2 items-center">
                <!-- Card 1 -->
                <div class="w-full sm:w-1/2 lg:w-1/5 px-2 mb-4 group" title="Siswa Hadir">
                    <div class="bg-white rounded-lg shadow flex items-center p-4 border-l-4 border-green-500 transition-colors group-hover:bg-green-500 group-hover:border-white group-hover:shadow-2xl dark:bg-gray-700 dark:border-green-600 dark:group-hover:bg-green-600">
                        <div class="flex-grow">
                            <h3 class="text-lg font-bold group-hover:text-white dark:group-hover:text-white">Hadir</h3>
                            <p class="text-gray-700 group-hover:text-white dark:text-gray-300 dark:group-hover:text-white">123</p>
                        </div>
                        <div class="bg-green-500 h-10 w-10 rounded ml-4 group-hover:bg-white dark:bg-green-600 dark:group-hover:bg-white"></div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="w-full sm:w-1/2 lg:w-1/5 px-2 mb-4 group" title="Siswa Sakit">
                    <div class="bg-white rounded-lg shadow flex items-center p-4 border-l-4 border-yellow-500 transition-colors group-hover:bg-yellow-500 group-hover:border-white group-hover:shadow-2xl dark:bg-gray-700 dark:border-yellow-600 dark:group-hover:bg-yellow-600">
                        <div class="flex-grow">
                            <h3 class="text-lg font-bold group-hover:text-white dark:group-hover:text-white">Sakit</h3>
                            <p class="text-gray-700 group-hover:text-white dark:text-gray-300 dark:group-hover:text-white">45</p>
                        </div>
                        <div class="bg-yellow-500 h-10 w-10 rounded ml-4 group-hover:bg-white dark:bg-yellow-600 dark:group-hover:bg-white"></div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="w-full sm:w-1/2 lg:w-1/5 px-2 mb-4 group" title="Siswa Izin">
                    <div class="bg-white rounded-lg shadow flex items-center p-4 border-l-4 border-blue-500 transition-colors group-hover:bg-blue-500 group-hover:border-white group-hover:shadow-2xl dark:bg-gray-700 dark:border-blue-600 dark:group-hover:bg-blue-600">
                        <div class="flex-grow">
                            <h3 class="text-lg font-bold group-hover:text-white dark:group-hover:text-white">Izin</h3>
                            <p class="text-gray-700 group-hover:text-white dark:text-gray-300 dark:group-hover:text-white">32</p>
                        </div>
                        <div class="bg-blue-500 h-10 w-10 rounded ml-4 group-hover:bg-white dark:bg-blue-600 dark:group-hover:bg-white"></div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="w-full sm:w-1/2 lg:w-1/5 px-2 mb-4 group" title="Siswa Alpha">
                    <div class="bg-white rounded-lg shadow flex items-center p-4 border-l-4 border-red-500 transition-colors group-hover:bg-red-500 group-hover:border-white group-hover:shadow-2xl dark:bg-gray-700 dark:border-red-600 dark:group-hover:bg-red-600">
                        <div class="flex-grow">
                            <h3 class="text-lg font-bold group-hover:text-white dark:group-hover:text-white">Alpha</h3>
                            <p class="text-gray-700 group-hover:text-white dark:text-gray-300 dark:group-hover:text-white">23</p>
                        </div>
                        <div class="bg-red-500 h-10 w-10 rounded ml-4 group-hover:bg-white dark:bg-red-600 dark:group-hover:bg-white"></div>
                    </div>
                </div>

                <!-- Dropdown Card -->
                <div class="w-full sm:w-1/2 lg:w-1/5 px-2 mb-4">
                    <div id="dropdownButton" class="bg-white rounded-lg shadow flex items-center p-4 border-l-4 border-red-500 transition-colors cursor-pointer dark:bg-gray-700 dark:border-red-600 dark:group-hover:bg-red-600">
                        <div class="flex items-center gap-7">
                            <h3 id="dropdownText" class="text-lg font-bold">Pilih Opsi</h3>
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                    </div>
                    <!-- Dropdown menu -->
                    <div id="dropdownMenu" class="dropdown-content absolute right-0 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-gray-800 dark:ring-gray-700 hidden">
                        <div class="py-1">
                            <a href="#" class="dropdown-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">Option 1</a>
                            <a href="#" class="dropdown-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">Option 2</a>
                            <a href="#" class="dropdown-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">Option 3</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart and Additional Box Container -->
            <div class="flex flex-col lg:flex-row gap-4">
                <div id="chartContainer" class="flex-1">
                    <canvas id="myChart" class="bg-slate-700 rounded-xl text-white"></canvas>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg h-72 w-full lg:w-1/4 overflow-y-auto hover:border-l-2 hover:border-r-2 border-green-500 transition-all dark:bg-gray-700 dark:border-green-600">
                    <!-- Additional content here -->
                </div>
            </div>
        </div>

        <script>
            document.getElementById('menu-toggle').addEventListener('click', function(event) {
                var sidebarMobile = document.getElementById('sidebarMobile');
                sidebarMobile.classList.toggle('active');
                event.stopPropagation();
            });

            document.addEventListener('click', function(event) {
                var sidebarMobile = document.getElementById('sidebarMobile');
                if (!sidebarMobile.contains(event.target) && !document.getElementById('menu-toggle').contains(event.target)) {
                    sidebarMobile.classList.remove('active');
                }
            });

            document.getElementById('dropdownButton').addEventListener('click', function(event) {
                var dropdownMenu = document.getElementById('dropdownMenu');
                dropdownMenu.classList.toggle('hidden');
                event.stopPropagation();
            });

            document.querySelectorAll('.dropdown-option').forEach(function(option) {
                option.addEventListener('click', function(event) {
                    event.preventDefault();
                    var dropdownText = document.getElementById('dropdownText');
                    dropdownText.textContent = this.textContent;
                    var dropdownMenu = document.getElementById('dropdownMenu');
                    dropdownMenu.classList.add('hidden');
                });
            });

            document.addEventListener('click', function(event) {
                var dropdownMenu = document.getElementById('dropdownMenu');
                if (!dropdownMenu.contains(event.target) && !document.getElementById('dropdownButton').contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });

            document.getElementById('theme-toggle').addEventListener('click', function() {
                document.body.classList.toggle('dark');
            });

            // Toggle search modal visibility
            document.getElementById('search-button').addEventListener('click', function() {
                document.getElementById('searchModal').style.display = 'flex';
            });

            // Close search modal when clicking outside
            document.getElementById('searchModal').addEventListener('click', function(event) {
                if (event.target === this) {
                    this.style.display = 'none';
                }
            });

            const ctx = document.getElementById('myChart').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    datasets: [{
                            label: 'Hadir',
                            data: [110, 120, 130, 140, 150, 160, 170, 180, 190, 200, 210, 220],
                            borderColor: 'green',
                            backgroundColor: 'rgba(0, 255, 0, 0.2)',
                            fill: true
                        },
                        {
                            label: 'Sakit',
                            data: [10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65],
                            borderColor: 'yellow',
                            backgroundColor: 'rgba(255, 255, 0, 0.2)',
                            fill: true
                        },
                        {
                            label: 'Izin',
                            data: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60],
                            borderColor: 'blue',
                            backgroundColor: 'rgba(0, 0, 255, 0.2)',
                            fill: true
                        },
                        {
                            label: 'Alpha',
                            data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                            borderColor: 'red',
                            backgroundColor: 'rgba(255, 0, 0, 0.2)',
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: {
                                color: '#ffffff'
                            }
                        },
                        y: {
                            ticks: {
                                color: '#ffffff'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#ffffff'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                title: function(tooltipItem) {
                                    return tooltipItem[0].label;
                                }
                            },
                            backgroundColor: '#000000',
                            titleColor: '#ffffff'
                        }
                    }
                }
            });
        </script>
        <script src="../src/js/script.js"></script>
    </div>
</body>

</html>
