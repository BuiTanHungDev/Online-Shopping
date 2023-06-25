window.addEventListener('DOMContentLoaded', function() {
    var movingDiv = document.getElementById('movingDiv');
    var opacity = 1;
    var translateY = 0;

    var interval = setInterval(function() {
        opacity -= 0.02; // Giảm giá trị opacity mỗi lần gọi
        translateY -= 1; // Giảm giá trị translateY mỗi lần gọi
        movingDiv.style.opacity = opacity;
        movingDiv.style.transform = 'translateY(' + translateY + 'px)';

        if (opacity <= 0) {
            clearInterval(interval); // Dừng vòng lặp khi opacity đạt giá trị 0
            movingDiv.style.display = 'none'; // Ẩn phần tử khi opacity đạt giá trị 0
        }
    }, 30); // Thời gian trong miligiây giữa các lần gọi
});