<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Ngọc Rồng Online Mini - HTML5 Canvas</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #333;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        canvas {
            background-color: #87CEEB; /* Bầu trời */
            border: 5px solid #ed1c24;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            margin-top: 20px;
            cursor: none;
        }
        .controls {
            margin-top: 15px;
            background: #444;
            padding: 10px 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <h2>NGỌC RỒNG ONLINE MINI</h2>
    
    <canvas id="gameCanvas" width="800" height="400"></canvas>

    <div class="controls">
        Di chuyển: <b>← → (Mũi tên)</b> | Nhảy: <b>Mũi tên Lên</b> | Chưởng: <b>Phím X</b>
    </div>

<script>
    const canvas = document.getElementById('gameCanvas');
    const ctx = canvas.getContext('2d');

    // Cấu hình nhân vật
    const player = {
        x: 50,
        y: 300,
        width: 40,
        height: 50,
        color: "#ff8000", // Màu áo Goku
        speed: 5,
        dx: 0,
        dy: 0,
        jumpPower: -12,
        gravity: 0.6,
        grounded: false,
        isAttacking: false,
        direction: "right"
    };

    // Quái vật (Nấm độc)
    const enemy = {
        x: 600,
        y: 320,
        width: 30,
        height: 30,
        color: "#7b00ff",
        alive: true
    };

    // Đạn (Kamejoko)
    let bullets = [];

    // Xử lý phím bấm
    const keys = {};
    window.addEventListener('keydown', e => keys[e.code] = true);
    window.addEventListener('keyup', e => {
        keys[e.code] = false;
        if (e.code === 'KeyX') shoot();
    });

    function shoot() {
        bullets.push({
            x: player.direction === "right" ? player.x + player.width : player.x - 20,
            y: player.y + 20,
            width: 20,
            height: 10,
            speed: player.direction === "right" ? 10 : -10,
            color: "#00ffff"
        });
    }

    function update() {
        // Di chuyển trái/phải
        if (keys['ArrowRight']) {
            player.dx = player.speed;
            player.direction = "right";
        } else if (keys['ArrowLeft']) {
            player.dx = -player.speed;
            player.direction = "left";
        } else {
            player.dx = 0;
        }

        // Nhảy
        if (keys['ArrowUp'] && player.grounded) {
            player.dy = player.jumpPower;
            player.grounded = false;
        }

        // Trọng lực
        player.dy += player.gravity;
        player.x += player.dx;
        player.y += player.dy;

        // Giới hạn mặt đất (Giả định mặt đất ở y = 350)
        if (player.y + player.height > 350) {
            player.y = 350 - player.height;
            player.dy = 0;
            player.grounded = true;
        }

        // Cập nhật đạn
        bullets.forEach((bullet, index) => {
            bullet.x += bullet.speed;
            // Kiểm tra va chạm với quái
            if (enemy.alive && bullet.x < enemy.x + enemy.width && bullet.x + bullet.width > enemy.x &&
                bullet.y < enemy.y + enemy.height && bullet.y + bullet.height > enemy.y) {
                enemy.alive = false;
                bullets.splice(index, 1);
            }
            // Xóa đạn khi bay ra khỏi màn hình
            if (bullet.x > canvas.width || bullet.x < 0) bullets.splice(index, 1);
        });
    }

    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Vẽ nền đất
        ctx.fillStyle = "#4d2600";
        ctx.fillRect(0, 350, canvas.width, 50);
        ctx.fillStyle = "#2d933c"; // Cỏ
        ctx.fillRect(0, 350, canvas.width, 10);

        // Vẽ nhân vật (Goku)
        ctx.fillStyle = player.color;
        ctx.fillRect(player.x, player.y, player.width, player.height);
        // Vẽ tóc
        ctx.fillStyle = "black";
        ctx.fillRect(player.x - 5, player.y - 10, player.width + 10, 15);

        // Vẽ quái vật
        if (enemy.alive) {
            ctx.fillStyle = enemy.color;
            ctx.fillRect(enemy.x, enemy.y, enemy.width, enemy.height);
            ctx.fillStyle = "white";
            ctx.fillText("QUÁI", enemy.x, enemy.y - 5);
        }

        // Vẽ đạn
        bullets.forEach(bullet => {
            ctx.fillStyle = bullet.color;
            ctx.beginPath();
            ctx.arc(bullet.x, bullet.y + 5, 8, 0, Math.PI * 2);
            ctx.fill();
            ctx.shadowBlur = 15;
            ctx.shadowColor = "#00ffff";
        });
        ctx.shadowBlur = 0; // Reset hiệu ứng bóng đổ cho các vật khác
    }

    function gameLoop() {
        update();
        draw();
        requestAnimationFrame(gameLoop);
    }

    gameLoop();
</script>
</body>
</html>