<?php
// Ubah file ini menjadi file PHP (misal: index.php) dan pastikan berada di server dengan PHP terpasang
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Valentine dari Khairinka untuk Artha</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #ff9a9e, #fad0c4);
      height: 100vh;
      overflow: hidden;
    }

    audio {
      position: fixed;
      top: 10px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 999;
    }

    .slider {
      display: flex;
      width: 700vw;
      height: 100vh;
      transition: transform 0.5s ease-in-out;
    }

    .slide {
      width: 100vw;
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      position: relative;
      padding: 20px;
      box-sizing: border-box;
      opacity: 0;
      transform: scale(0.95);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .slide.active {
      opacity: 1;
      transform: scale(1);
    }

    .slide1 {
      background-image: url('https://images.unsplash.com/photo-1512546321483-d333b8c7d487?auto=format&fit=crop&w=800&q=80');
      background-size: cover;
      color: white;
    }

    .pin-grid {
      display: grid;
      grid-template-columns: repeat(3, 60px);
      gap: 10px;
      margin-top: 20px;
    }

    .pin-grid button {
      font-size: 20px;
      padding: 10px;
      border-radius: 10px;
      border: none;
      background-color: rgba(255, 255, 255, 0.7);
      cursor: pointer;
    }

    .pin-display {
      margin-top: 10px;
      font-size: 24px;
      letter-spacing: 4px;
      background: rgba(255,255,255,0.5);
      padding: 5px 15px;
      border-radius: 8px;
      color: black;
    }

    .slide2 {
      background-color: #fff0f5;
      color: #d63384;
    }

    .slide2 input {
      padding: 10px;
      font-size: 16px;
      border-radius: 8px;
      border: 2px solid #d63384;
      margin-bottom: 20px;
    }

    .slide3 {
      background-color: #ffe0e9;
      color: #d63384;
    }

    .menu {
      display: flex;
      flex-direction: column;
      gap: 20px;
      align-items: center;
      margin-top: 40px;
    }

    .menu button {
      padding: 10px 20px;
      font-size: 18px;
      border: none;
      border-radius: 8px;
      background-color: #d63384;
      color: white;
      cursor: pointer;
    }

    .slide4, .slide5, .slide6 {
      background-color: #fff;
      color: #333;
      text-align: center;
    }

    .slide4 h1, .slide5 h1, .slide6 h1 {
      color: #e83e8c;
    }

    .flip-card {
      background-color: transparent;
      width: 300px;
      height: 200px;
      perspective: 1000px;
    }

    .flip-card-inner {
      position: relative;
      width: 100%;
      height: 100%;
      text-align: center;
      transition: transform 0.6s;
      transform-style: preserve-3d;
    }

    .flip-card:hover .flip-card-inner {
      transform: rotateY(180deg);
    }

    .flip-card-front, .flip-card-back {
      position: absolute;
      width: 100%;
      height: 100%;
      -webkit-backface-visibility: hidden;
      backface-visibility: hidden;
      border-radius: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .flip-card-front {
      background-color: #ffc1cc;
      color: black;
    }

    .flip-card-back {
      background-color: #ffe4e1;
      color: black;
      transform: rotateY(180deg);
    }

    .nav-buttons {
      position: absolute;
      bottom: 20px;
      width: 100%;
      display: flex;
      justify-content: center;
    }

    .nav-buttons button {
      background-color: rgba(255, 255, 255, 0.7);
      border: none;
      border-radius: 10px;
      padding: 8px 16px;
      font-weight: bold;
      cursor: pointer;
    }

    .heart {
      position: fixed;
      width: 20px;
      height: 20px;
      background: pink;
      transform: rotate(45deg);
      animation: fall 6s linear infinite;
      border-radius: 50% 50% 0 0;
      z-index: 0;
    }

    .heart::before,
    .heart::after {
      content: "";
      position: absolute;
      width: 20px;
      height: 20px;
      background: pink;
      border-radius: 50%;
    }

    .heart::before {
      top: -10px;
      left: 0;
    }

    .heart::after {
      left: -10px;
      top: 0;
    }

    @keyframes fall {
      0% {
        top: -10%;
        opacity: 1;
      }
      100% {
        top: 110%;
        opacity: 0;
        }
      }
    #slideshowImage{
      max-width: 100%;
      max-height: 80vh;
      object-fit: cover;
      border-radius: 10px;
    }
    }
  </style>
</head>
<body>
  <audio id="backgroundAudio" controls autoplay loop>
    <source src="assets/lagu_ulang_tahun.mp3" type="audio/mpeg">
    Browsermu tidak mendukung audio.
  </audio>

<div class="slider" id="slider">
  <!-- Slide 1 - PIN -->
  <div class="slide slide1 active">
    <h1>Masukkan PIN Kamu</h1>
    <img src="https://picsum.photos/id/1005/200/150" alt="Valentine Image" style="margin-top:10px; border-radius:10px;" />
    <div class="pin-display" id="pinDisplay"></div>
    <div class="pin-grid" id="pinButtons"></div>
  </div>
  <!-- Slide 2 - Nama -->
  <div class="slide slide2">
    <h2>Siapa nama kamu? 🥰</h2>
    <input type="text" id="nameInput" placeholder="Tulis di sini..." />
    <button onclick="handleNameSubmit()">Lanjut</button>
  </div>
  <!-- Slide 3 - Menu -->
  <div class="slide slide3">
    <h2>HAPPY BIRTHDAY! <span id="displayName"></span> 💖</h2>
    <div class="menu">
      <button onclick="goToSlide(3)">Pesan</button>
      <button onclick="goToSlide(4)">Foto</button>
      <button onclick="goToSlide(5)">Waktu</button>
    </div>
  </div>
  <!-- Slide 4 - Pesan -->
  <div class="slide slide4">
    <h1>HAPPY BIRTHDAY SAYANG 💌</h1>
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <p>Sentuh untuk lihat isi</p>
        </div>
        <div class="flip-card-back">
          <p>SELAMAT ULANG TAHUN Yaa Sayangku, semoga apa yang kamu doain bisa tercapai, terus menjadi cewek tangguh, Semoga kedepannya karirnya makin sukses, Semoga makin sayang sama Wafa,I love You ❤️</p>
        </div>
      </div>
    </div>
    <div class="nav-buttons">
      <button onclick="goToSlide(2)">← Kembali</button>
    </div>
  </div>
  <!-- Slide 5 - Foto -->
  <div class="slide slide5">
    <h1>Buat Kamu Cantik📸</h1>
    <img id="slideshowImage" src="assets/foto1.jpg" style="border-radius:10px;" />
    <div class="nav-buttons">
      <button onclick="goToSlide(2)">← Kembali</button>
    </div>
  </div>
  <!-- Slide 6 - Waktu -->
  <div class="slide slide6">
    <h1>Berapa Hari yang sudah kamu lalui di dunia ini ⏳</h1>
    <p id="elapsedTime"></p>
    <div class="nav-buttons">
      <button onclick="goToSlide(2)">← Kembali</button>
    </div>
  </div>
</div>

<script>
  let currentSlide = 0;
  const slider = document.getElementById("slider");
  const displayName = document.getElementById("displayName");
  let userName = "";

  function goToSlide(n) {
    const slides = document.querySelectorAll('.slide');
    slides.forEach((slide, index) => {
      slide.classList.remove('active');
      if (index === n) {
        slide.classList.add('active');
      }
    });
    currentSlide = n;
    slider.style.transform = `translateX(-${n * 100}vw)`;
  }

  function handleNameSubmit() {
    const input = document.getElementById("nameInput").value.trim();
    if (input === "") {
      alert("Masukkan nama dulu yaa :)");
      return;
    }
    userName = input;
    if (displayName) displayName.textContent = userName;
    goToSlide(2);
  }

  // PIN logic
  const pinButtons = document.getElementById("pinButtons");
  const pinDisplay = document.getElementById("pinDisplay");
  let enteredPin = "";
  const correctPin = "250403";

  for (let i = 1; i <= 9; i++) {
    pinButtons.innerHTML += `<button onclick="enterPin('${i}')">${i}</button>`;
  }
  pinButtons.innerHTML += `<button onclick="deletePin()">⌫</button>`;
  pinButtons.innerHTML += `<button onclick="enterPin('0')">0</button>`;

  function enterPin(num) {
    if (enteredPin.length < 6) {
      enteredPin += num;
      pinDisplay.textContent = '*'.repeat(enteredPin.length);
    }
    if (enteredPin === correctPin) {
      setTimeout(() => goToSlide(1), 500);
    } else if (enteredPin.length === 6) {
      alert("Kode salah, coba lagi!");
      enteredPin = "";
      pinDisplay.textContent = "";
    }
  }

  function deletePin() {
    enteredPin = enteredPin.slice(0, -1);
    pinDisplay.textContent = '*'.repeat(enteredPin.length);
  }

  // Waktu berlalu
  function updateElapsedTime() {
    const start = new Date("2003-04-25T00:00:00");
    const now = new Date();
    const diff = now - start;
    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    document.getElementById("elapsedTime").textContent = `Sudah ${days} hari sejak 25 April 2003 ❤️`;
  }
  updateElapsedTime();

  // Slideshow logic
  const slideshowImage = document.getElementById("slideshowImage");
  const slideshowImages = [
    "assets/foto3.jpg",
    "assets/foto4.jpg",
    "assets/foto5.jpg",
    "assets/foto6.jpg",
    "assets/foto7.jpg",
    "assets/foto8.jpg",
    "assets/foto9.jpg",
    "assets/foto10.jpg",
  ];
  let imgIndex = 0;
  setInterval(() => {
    imgIndex = (imgIndex + 1) % slideshowImages.length;
    slideshowImage.src = slideshowImages[imgIndex];
  }, 2000);
  // Animasi hati jatuh
  function createHeart() {
    const heart = document.createElement("div");
    heart.classList.add("heart");
    heart.style.left = Math.random() * 100 + "vw";
    heart.style.animationDuration = (Math.random() * 3 + 3) + "s";
    document.body.appendChild(heart);
    setTimeout(() => {
      heart.remove();
    }, 6000);
  }
  setInterval(createHeart, 500);
</script>
</body>
</html>
