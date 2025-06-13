<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // fitur transparan header
    const header = document.querySelector('.Headerbg');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) { // Sesuaikan nilai 100 dengan posisi gulir yang diinginkan
            header.classList.add('Headerbg-full-opacity');
        } else {
            header.classList.remove('Headerbg-full-opacity');
        }
    });

    // slider testimonial
    document.addEventListener('DOMContentLoaded', function () {
        const slider = document.querySelector('.testimonial-slider');
        const items = document.querySelectorAll('.testimonial-item');
        const prevButton = document.querySelector('.prev');
        const nextButton = document.querySelector('.next');
        let currentItem = 0;

        function showItem(index) {
            items.forEach(item => item.classList.remove('active'));
            items[index].classList.add('active');
        }

        function nextItem() {
            currentItem = (currentItem + 1) % items.length;
            showItem(currentItem);
        }

        function prevItem() {
            currentItem = (currentItem - 1 + items.length) % items.length;
            showItem(currentItem);
        }

        nextButton.addEventListener('click', nextItem);
        prevButton.addEventListener('click', prevItem);
    });

    // sidebar
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const content = document.querySelector('.container'); // Atau elemen konten utama Anda

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
                if (content) {
                    content.classList.toggle('open');
                }
            });
        }
    });
</script>