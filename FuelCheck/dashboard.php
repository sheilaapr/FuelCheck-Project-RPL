<?php
session_start();
include 'auth/db.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FuelCheck - Pantau & Laporkan Kecurangan BBM</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#3B82F6', secondary: '#10B981' }, borderRadius: { 'none': '0px', 'sm': '4px', DEFAULT: '8px', 'md': '12px', 'lg': '16px', 'xl': '20px', '2xl': '24px', '3xl': '32px', 'full': '9999px', 'button': '8px' } } } }</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
    <style>
        :where([class^="ri-"])::before {
            content: "\f3c2";
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-section {
            background-image: url('https://readdy.ai/api/search-image?query=A%20modern%20gas%20station%20with%20fuel%20pumps%20under%20a%20bright%20blue%20sky.%20The%20left%20side%20of%20the%20image%20has%20a%20smooth%20gradient%20to%20a%20lighter%20background%2C%20creating%20a%20perfect%20space%20for%20text%20overlay.%20The%20gas%20station%20appears%20clean%20and%20well-maintained%2C%20with%20people%20refueling%20their%20vehicles.%20The%20image%20has%20a%20professional%2C%20high-quality%20look%20with%20natural%20lighting%20and%20clear%20details%20of%20the%20gas%20station%20infrastructure.&width=1920&height=800&seq=1&orientation=landscape');
            background-size: cover;
            background-position: center;
        }

        .hero-overlay {
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 50%, rgba(255, 255, 255, 0) 100%);
        }

        input:focus {
            outline: none;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header & Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <a href="dashboard.php" class="font-['Pacifico'] text-2xl text-primary">FuelCheck</a>
            <nav class="hidden md:flex items-center space-x-6">
                <a href="dashboard.php" class="text-gray-900 font-medium hover:text-primary transition">Beranda</a>
                <a href="laporan.php" class="text-gray-600 hover:text-primary transition">Lapor</a>
                <a href="spbu.php" class="text-gray-600 hover:text-primary transition">SPBU</a>
                <a href="#" class="text-gray-600 hover:text-primary transition">Profil</a>
            </nav>

            <!-- <div class="flex items-center space-x-4">
                <a href="login.php"
                    class="text-gray-600 hover:text-primary px-3 py-2 rounded-button whitespace-nowrap">Masuk</a>
                <a href="register.php"
                    class="bg-primary text-white px-4 py-2 rounded-button hover:bg-blue-600 transition whitespace-nowrap">Daftar</a>
            </div> -->
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section relative">
        <div class="hero-overlay w-full h-full absolute inset-0"></div>
        <div class="container mx-auto px-4 py-20 relative">
            <div class="w-full max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Pantau & Laporkan Kecurangan BBM</h1>
                <p class="text-lg text-gray-700 mb-8">Bersama-sama kita ciptakan transparansi di setiap SPBU. Laporkan
                    kecurangan, berikan ulasan, dan bantu masyarakat mendapatkan BBM yang berkualitas.</p>
                <a href="lapor.php" class="bg-primary text-white px-6 py-3 rounded-button text-lg font-medium hover:bg-blue-600 transition shadow-lg whitespace-nowrap">Lapor Sekarang</a>

                <div class="mt-12 grid grid-cols-3 gap-6">
                    <div class="bg-white bg-opacity-90 p-4 rounded-lg shadow-sm text-center">
                        <p class="text-2xl font-bold text-primary">1,245</p>
                        <p class="text-gray-600">Laporan</p>
                    </div>
                    <div class="bg-white bg-opacity-90 p-4 rounded-lg shadow-sm text-center">
                        <p class="text-2xl font-bold text-primary">328</p>
                        <p class="text-gray-600">SPBU Terdaftar</p>
                    </div>
                    <div class="bg-white bg-opacity-90 p-4 rounded-lg shadow-sm text-center">
                        <p class="text-2xl font-bold text-primary">5,670</p>
                        <p class="text-gray-600">Pengguna Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Fitur Utama</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-alert-line ri-xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Pelaporan Kecurangan</h3>
                    <p class="text-gray-600">Laporkan kecurangan BBM dengan mudah melalui aplikasi. Lengkapi dengan
                        bukti foto dan deskripsi detail.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-star-line ri-xl text-secondary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Ulasan SPBU</h3>
                    <p class="text-gray-600">Berikan rating dan ulasan untuk SPBU yang telah Anda kunjungi. Bantu
                        pengguna lain mendapatkan informasi akurat.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-shield-check-line ri-xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Verifikasi Admin</h3>
                    <p class="text-gray-600">Setiap laporan diverifikasi oleh admin untuk memastikan keakuratan data dan
                        tindak lanjut yang tepat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Peta Interaktif -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4">Temukan SPBU Terdekat</h2>
            <p class="text-gray-600 text-center mb-12">Lihat lokasi dan informasi SPBU di sekitar Anda</p>

            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-1/4 bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Filter Pencarian</h3>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Lokasi</label>
                        <div class="relative">
                            <input type="text" placeholder="Masukkan lokasi"
                                class="w-full px-4 py-2 border border-gray-300 rounded text-sm">
                            <div class="absolute right-3 top-2 w-5 h-5 flex items-center justify-center">
                                <i class="ri-map-pin-line text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Rating Minimum</label>
                        <div class="flex items-center space-x-1 mb-2">
                            <i class="ri-star-fill text-yellow-400"></i>
                            <i class="ri-star-fill text-yellow-400"></i>
                            <i class="ri-star-fill text-yellow-400"></i>
                            <i class="ri-star-line text-gray-300"></i>
                            <i class="ri-star-line text-gray-300"></i>
                        </div>
                        <input type="range" min="1" max="5" value="3"
                            class="w-full h-2 bg-gray-200 rounded-full appearance-none cursor-pointer">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Jenis BBM</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <div class="relative flex items-center">
                                    <input type="checkbox" class="opacity-0 absolute h-5 w-5" checked>
                                    <div
                                        class="bg-white border-2 border-gray-300 rounded w-5 h-5 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-primary">
                                        <div class="opacity-0 transform scale-0 bg-primary w-3 h-3 rounded"></div>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-700">Pertamax</span>
                            </label>
                            <label class="flex items-center">
                                <div class="relative flex items-center">
                                    <input type="checkbox" class="opacity-0 absolute h-5 w-5" checked>
                                    <div
                                        class="bg-white border-2 border-gray-300 rounded w-5 h-5 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-primary">
                                        <div class="opacity-0 transform scale-0 bg-primary w-3 h-3 rounded"></div>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-700">Pertalite</span>
                            </label>
                            <label class="flex items-center">
                                <div class="relative flex items-center">
                                    <input type="checkbox" class="opacity-0 absolute h-5 w-5">
                                    <div
                                        class="bg-white border-2 border-gray-300 rounded w-5 h-5 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-primary">
                                        <div class="opacity-0 transform scale-0 bg-primary w-3 h-3 rounded"></div>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-700">Solar</span>
                            </label>
                            <label class="flex items-center">
                                <div class="relative flex items-center">
                                    <input type="checkbox" class="opacity-0 absolute h-5 w-5">
                                    <div
                                        class="bg-white border-2 border-gray-300 rounded w-5 h-5 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-primary">
                                        <div class="opacity-0 transform scale-0 bg-primary w-3 h-3 rounded"></div>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-700">Dexlite</span>
                            </label>
                        </div>
                    </div>

                    <button
                        class="w-full bg-primary text-white py-2 rounded-button hover:bg-blue-600 transition whitespace-nowrap">Terapkan
                        Filter</button>
                </div>

                <div class="w-full md:w-3/4 bg-white rounded-lg shadow-sm overflow-hidden h-[500px] relative">
                    <div class="absolute inset-0 bg-cover bg-center"
                        style="background-image: url('https://public.readdy.ai/gen_page/map_placeholder_1280x720.png')">
                    </div>

                    <div class="absolute top-4 left-4 bg-white p-2 rounded-lg shadow-md">
                        <div class="flex items-center space-x-2 mb-2">
                            <div class="w-4 h-4 rounded-full bg-green-500"></div>
                            <span class="text-sm">Aman</span>
                        </div>
                        <div class="flex items-center space-x-2 mb-2">
                            <div class="w-4 h-4 rounded-full bg-yellow-500"></div>
                            <span class="text-sm">Perlu Perhatian</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-4 h-4 rounded-full bg-red-500"></div>
                            <span class="text-sm">Banyak Laporan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Laporan Terkini -->
    <section class="py-8 bg-white rounded-xl shadow mb-10">
      <div class="px-4">
        <h2 class="text-3xl font-bold text-center mb-4">Laporan Terkini</h2>
        <p class="text-gray-600 text-center mb-8">Laporan kecurangan BBM yang telah diverifikasi</p>
        <div class="overflow-x-auto">
          <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">SPBU</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Jenis Kecurangan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <?php
              $laporan = $conn->query("SELECT l.*, s.nama_spbu, s.lokasi FROM laporan l JOIN spbu s ON l.spbu_id = s.id ORDER BY l.created_at DESC LIMIT 5");
              while ($row = $laporan->fetch_assoc()): ?>
              <tr>
                <td class="px-6 py-4">
                  <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($row['nama_spbu']) ?></div>
                  <div class="text-sm text-gray-500"><?= htmlspecialchars($row['lokasi']) ?></div>
                </td>
                <td class="px-6 py-4">
                  <div class="text-sm text-gray-900"><?= htmlspecialchars($row['deskripsi']) ?></div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500"><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                <td class="px-6 py-4">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                    <?= ($row['status'] == 'Ditolak' ? 'bg-red-100 text-red-800' : ($row['status'] == 'Dalam Proses' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800')) ?>">
                    <?= htmlspecialchars($row['status']) ?>
                  </span>
                </td>
                <td class="px-6 py-4 text-sm font-medium">
                  <a href="spbu.php" class="text-primary hover:text-blue-800">Detail</a>
                </td>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <a href="#" class="font-['Pacifico'] text-2xl text-white mb-4 block">FuelCheck</a>
                    <p class="text-gray-400 mb-4">Aplikasi untuk memantau dan melaporkan kecurangan BBM di SPBU.
                        Dikembangkan dengan metode Agile (Scrum) agar cepat beradaptasi dengan kebutuhan pengguna.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="ri-facebook-fill"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="ri-twitter-fill"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="ri-instagram-fill"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="ri-youtube-fill"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Link Penting</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Cara Kerja</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Bantuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Karir</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Kebijakan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Kebijakan Cookie</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Kebijakan Refund</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Lisensi</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="ri-map-pin-line mt-1 mr-2"></i>
                            <span class="text-gray-400">Jl. Jendral Sudirman No. 28, Jakarta Pusat, 10210</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-phone-line mr-2"></i>
                            <span class="text-gray-400">+62 21 5678 9012</span>
                        </li>
                        <li class="flex items-center">
                            <i class="ri-mail-line mr-2"></i>
                            <span class="text-gray-400">info@fuelcheck.id</span>
                        </li>
                    </ul>

                    <div class="mt-6">
                        <h4 class="text-sm font-medium mb-2">Berlangganan Newsletter</h4>
                        <div class="flex">
                            <input type="email" placeholder="Email Anda"
                                class="px-4 py-2 rounded-l-button text-gray-900 w-full border-none">
                            <button
                                class="bg-primary text-white px-4 py-2 rounded-r-button hover:bg-blue-600 transition whitespace-nowrap">Langganan</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">© 2025 FuelCheck. Hak Cipta Dilindungi.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <i class="ri-visa-line text-gray-400 text-xl"></i>
                    <i class="ri-mastercard-line text-gray-400 text-xl"></i>
                    <i class="ri-paypal-line text-gray-400 text-xl"></i>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Checkbox functionality
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const div = this.nextElementSibling.querySelector('div');
                    if (this.checked) {
                        div.classList.remove('opacity-0', 'scale-0');
                        div.classList.add('opacity-100', 'scale-100');
                    } else {
                        div.classList.add('opacity-0', 'scale-0');
                        div.classList.remove('opacity-100', 'scale-100');
                    }
                });

                // Initialize state
                const div = checkbox.nextElementSibling.querySelector('div');
                if (checkbox.checked) {
                    div.classList.remove('opacity-0', 'scale-0');
                    div.classList.add('opacity-100', 'scale-100');
                }
            });
        });
    </script>
</body>

</html>