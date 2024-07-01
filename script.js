document.addEventListener('DOMContentLoaded', function() {
    fetch('get_menu.php')
    .then(response => response.json())
    .then(data => {
        const menuItems = document.getElementById('menu-items');
        data.forEach(item => {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'menu-item';
            itemDiv.innerHTML = `
                <img src="${item.image_url}" alt="${item.name}" class="menu-image">
                <h3>${item.name}</h3>
                <p>$${item.price}</p>
            `;
            menuItems.appendChild(itemDiv);
        });
    })
    .catch(error => console.error('Error:', error));

    // 處理訂單提交
    const orderForm = document.getElementById('order-form');
    orderForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(orderForm);
        fetch('submit_order.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            alert(result);
            orderForm.reset();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('載入菜單失敗：' + error.message);
        });
    });
});

let index = 0;
let slides = document.querySelectorAll('.slide');

function showSlides(n) {
    for (let i = n; i < n + 3; i++) {
        if (i < slides.length) {
            slides[i].classList.add('active');
        }
    }
}

function nextSlide() {
    slides.forEach(slide => slide.classList.remove('active'));
    index = (index + 3) % slides.length;
    showSlides(index);
}

showSlides(index);
setInterval(nextSlide, 2000);  // 每 2 秒切換一次圖片

