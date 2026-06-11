document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.redeem-filter-button');
    const cards = document.querySelectorAll('[data-category]');

    function setActiveFilter(selectedButton) {
        filterButtons.forEach((button) => {
            button.classList.toggle('bg-amber-600', button === selectedButton);
            button.classList.toggle('text-white', button === selectedButton);
            button.classList.toggle('border-slate-300', button !== selectedButton);
            button.classList.toggle('bg-white', button !== selectedButton);
        });
    }

    function applyCategoryFilter(category) {
        cards.forEach((card) => {
            const cardCategory = card.dataset.category;
            const matches = category === 'all' || cardCategory === category;
            card.style.display = matches ? '' : 'none';
        });
    }

    filterButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const filter = button.dataset.filter;
            setActiveFilter(button);
            applyCategoryFilter(filter);
        });
    });

    const defaultButton = document.querySelector('.redeem-filter-button[data-filter="all"]');
    if (defaultButton) {
        setActiveFilter(defaultButton);
    }
});
