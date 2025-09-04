// script.js

// Alert saat produk ditambahkan ke keranjang
function addToCart(productId) {
    alert("Produk telah ditambahkan ke keranjang!");
    // Redirect kembali ke halaman utama setelah klik OK
    window.location.href = "index.php";
}

// Buy langsung (tanpa masuk keranjang)
function buyNow(productId) {
    // Redirect langsung ke checkout dengan productId
    window.location.href = "checkout.php?buy=" + productId;
}

// Navbar active link effect
document.addEventListener("DOMContentLoaded", () => {
    const currentPath = window.location.pathname.split("/").pop();
    const navLinks = document.querySelectorAll(".navbar a");

    navLinks.forEach(link => {
        if (link.getAttribute("href") === currentPath) {
            link.classList.add("active");
        }
    });
});

// Animasi fade-in untuk card produk
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".product-card");
    cards.forEach((card, i) => {
        setTimeout(() => {
            card.classList.add("show");
        }, i * 200); // delay per kartu
    });
});

// Validasi form register
function validateRegister() {
    const password = document.getElementById("password").value;
    const confirm = document.getElementById("confirm_password").value;

    if (password !== confirm) {
        alert("Password dan konfirmasi password tidak sama!");
        return false;
    }
    return true;
}

// Validasi checkout
function validateCheckout() {
    const phone = document.getElementById("phone").value;
    if (phone.length < 10) {
        alert("Nomor telepon tidak valid!");
        return false;
    }
    return true;
}