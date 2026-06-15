document.addEventListener('DOMContentLoaded', function () {
    const onlyDigits = (value, maxLength) => value.replace(/\D/g, '').slice(0, maxLength);

    const inputMasks = {
        telefone(value) {
            const digits = onlyDigits(value, 11);

            if (digits.length <= 2) {
                return digits ? `(${digits}` : '';
            }

            if (digits.length <= 6) {
                return `(${digits.slice(0, 2)}) ${digits.slice(2)}`;
            }

            const numberStart = digits.slice(2, digits.length === 11 ? 7 : 6);
            const numberEnd = digits.slice(digits.length === 11 ? 7 : 6);

            return `(${digits.slice(0, 2)}) ${numberStart}-${numberEnd}`;
        },

        cpf(value) {
            const digits = onlyDigits(value, 11);

            return digits
                .replace(/^(\d{3})(\d)/, '$1.$2')
                .replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3')
                .replace(/\.(\d{3})(\d)/, '.$1-$2');
        },

        cep(value) {
            return onlyDigits(value, 8).replace(/^(\d{5})(\d)/, '$1-$2');
        },

        cnpj(value) {
            const digits = onlyDigits(value, 14);

            return digits
                .replace(/^(\d{2})(\d)/, '$1.$2')
                .replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3')
                .replace(/\.(\d{3})(\d)/, '.$1/$2')
                .replace(/(\d{4})(\d)/, '$1-$2');
        },
    };

    const maskSelectors = [
        ['telefone', 'input[name="telefone"], input[data-mask="telefone"]'],
        ['cpf', 'input[name="cpf"], input[data-mask="cpf"]'],
        ['cep', 'input[name="cep"], input[data-mask="cep"]'],
        ['cnpj', 'input[name="cnpj"], input[data-mask="cnpj"]'],
    ];

    maskSelectors.forEach(([maskName, selector]) => {
        document.querySelectorAll(selector).forEach((input) => {
            const applyMask = () => {
                input.value = inputMasks[maskName](input.value);
            };

            input.inputMode = 'numeric';
            input.autocomplete = maskName === 'telefone' ? 'tel' : 'off';
            input.maxLength = {
                telefone: 15,
                cpf: 14,
                cep: 9,
                cnpj: 18,
            }[maskName];

            input.addEventListener('input', applyMask);
            applyMask();
        });
    });

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
