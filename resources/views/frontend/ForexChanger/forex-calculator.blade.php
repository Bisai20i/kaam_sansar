@extends('frontend.layouts.main')

@section('title', 'Forex Calculator')

@section('content')
    <!-- hero section start  -->
    <section class="hero container-fluid primary_color_bg py-4"
        style="background-image: url({{ asset('frontend/assets/Images/money-around-world.jpg') }}); background-position: center center; background-size:cover; background-repeat: no-repeat; ">
        <div class="text-center text-white">
            <h1 class="mt-5">Real-Time Currency Conversion at Your Fingertips</h1>
            <p class="fs-5 mt-2">Stay updated with the latest exchange rates and calculate conversions
                effortlessly.
            </p>
            <p class="fs-2 fw-bolder"> Start Converting Now!</p>
        </div>
    </section>
    <!-- hero section end  -->

    <section class="converter container">
        <div class="row text-center w-auto justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="container d-flex justify-content-end">
                        <button class="bg-white border-0 border-bottom border-primary mt-2"><a
                                href="{{ route('moneyExchanges.create') }}"
                                class="text-decoration-none text-primary fw-semibold fs-6">Become a Money Exchanger<i
                                    class="bi bi-arrow-right ms-2"></i></a></button>
                    </div>
                    <div class="">
                        <h1 class="primary_color_text">Foreign Exchange Currency Converter</h1>
                    </div>
                </div>
                <div class="row mt-4">
                    <ul class="nav nav-pills justify-content-center gap-3" id="myNavTabs">
                        <li class="nav-item">
                            <button class="nav-link active fw-bold fs-5 primary_border" id="tab1" data-bs-toggle="tab"
                                data-bs-target="#tab1Content">Buying Foreign
                                Currency</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fw-bold fs-5 primary_border" id="tab2" data-bs-toggle="tab"
                                data-bs-target="#tab2Content">Selling Foreign
                                Currency</button>
                        </li>
                    </ul>
                </div>

                <div class="row justify-content-center align-items-center row-gap-3 my-4">
                    <!-- From Currency -->
                    <div class="dropdown col-md-5 col-6 flex-md-fill pe-md-0 justify-content-lg-end" id="fromCurrencyDropdown">
                        <button class="btn primary_color_border currency-selector dropdown-toggle me-md-0 m-auto"
                            type="button" id="fromCurrency" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="flag-icon flag-icon-np"></span>
                            NPR
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="fromCurrency">
                            <li><a class="dropdown-item" href="#" data-currency="NPR" data-flag="np"><span
                                        class="flag-icon flag-icon-np"></span> NPR - Nepalese Rupees</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="USD" data-flag="us"><span
                                        class="flag-icon flag-icon-us"></span> USD - US Dollar</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="EUR" data-flag="eu"><span
                                        class="flag-icon flag-icon-eu"></span> EUR - Euro</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="GBP" data-flag="gb"><span
                                        class="flag-icon flag-icon-gb"></span> GBP - British Pound</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="JPY" data-flag="jp"><span
                                        class="flag-icon flag-icon-jp"></span> JPY - Japanese Yen</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="AUD" data-flag="au"><span
                                        class="flag-icon flag-icon-au"></span> AUD - Australian Dollar</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="CAD" data-flag="ca"><span
                                        class="flag-icon flag-icon-ca"></span> CAD - Canadian Dollar</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="CHF" data-flag="ch"><span
                                        class="flag-icon flag-icon-ch"></span> CHF - Swiss Franc</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="CNY" data-flag="cn"><span
                                        class="flag-icon flag-icon-cn"></span> CNY - Chinese Yuan</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="HKD" data-flag="hk"><span
                                        class="flag-icon flag-icon-hk"></span> HKD - Hong Kong Dollar</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="NZD" data-flag="nz"><span
                                        class="flag-icon flag-icon-nz"></span> NZD - New Zealand Dollar</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="SEK" data-flag="se"><span
                                        class="flag-icon flag-icon-se"></span> SEK - Swedish Krona</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="KRW" data-flag="kr"><span
                                        class="flag-icon flag-icon-kr"></span> KRW - South Korean Won</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="SGD" data-flag="sg"><span
                                        class="flag-icon flag-icon-sg"></span> SGD - Singapore Dollar</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="NOK" data-flag="no"><span
                                        class="flag-icon flag-icon-no"></span> NOK - Norwegian Krone</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="MXN" data-flag="mx"><span
                                        class="flag-icon flag-icon-mx"></span> MXN - Mexican Peso</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="INR" data-flag="in"><span
                                        class="flag-icon flag-icon-in"></span> INR - Indian Rupee</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="RUB" data-flag="ru"><span
                                        class="flag-icon flag-icon-ru"></span> RUB - Russian Ruble</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="ZAR" data-flag="za"><span
                                        class="flag-icon flag-icon-za"></span> ZAR - South African Rand</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="TRY" data-flag="tr"><span
                                        class="flag-icon flag-icon-tr"></span> TRY - Turkish Lira</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="BRL" data-flag="br"><span
                                        class="flag-icon flag-icon-br"></span> BRL - Brazilian Real</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="THB" data-flag="th"><span
                                        class="flag-icon flag-icon-th"></span> THB - Thai Baht</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="AED" data-flag="ae"><span
                                        class="flag-icon flag-icon-ae"></span> AED - UAE Dirham</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="DKK" data-flag="dk"><span
                                        class="flag-icon flag-icon-dk"></span> DKK - Danish Krone</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="PLN" data-flag="pl"><span
                                        class="flag-icon flag-icon-pl"></span> PLN - Polish Złoty</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="IDR" data-flag="id"><span
                                        class="flag-icon flag-icon-id"></span> IDR - Indonesian Rupiah</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="ILS" data-flag="il"><span
                                        class="flag-icon flag-icon-il"></span> ILS - Israeli Shekel</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="PHP" data-flag="ph"><span
                                        class="flag-icon flag-icon-ph"></span> PHP - Philippine Peso</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="CZK" data-flag="cz"><span
                                        class="flag-icon flag-icon-cz"></span> CZK - Czech Koruna</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="RON" data-flag="ro"><span
                                        class="flag-icon flag-icon-ro"></span> RON - Romanian Leu</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="HUF" data-flag="hu"><span
                                        class="flag-icon flag-icon-hu"></span> HUF - Hungarian Forint</a></li>
                        </ul>
                    </div>

                    <!-- To Text -->
                    <div class=" col-md-auto col-12 m-auto justify-content-center">
                        <span class="fw-bold">to</span>
                    </div>

                    <!-- To Currency -->
                    <div class="dropdown col-md-5 col-6  flex-md-fill ps-md-0">
                        <button class="btn primary_color_border currency-selector dropdown-toggle m-auto ms-md-0"
                            type="button" id="toCurrency" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="flag-icon flag-icon-us"></span>
                            USD
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="toCurrency">
                            <li><a class="dropdown-item" href="#" data-currency="NPR" data-flag="np"><span
                                        class="flag-icon flag-icon-np"></span> NPR - Nepalese Rupees</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="USD" data-flag="us"><span
                                        class="flag-icon flag-icon-us"></span> USD - US Dollar</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="EUR" data-flag="eu"><span
                                        class="flag-icon flag-icon-eu"></span> EUR - Euro</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="GBP" data-flag="gb"><span
                                        class="flag-icon flag-icon-gb"></span> GBP - British Pound</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="JPY" data-flag="jp"><span
                                        class="flag-icon flag-icon-jp"></span> JPY - Japanese Yen</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="AUD" data-flag="au"><span
                                        class="flag-icon flag-icon-au"></span> AUD - Australian Dollar</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="CAD" data-flag="ca"><span
                                        class="flag-icon flag-icon-ca"></span> CAD - Canadian Dollar</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="CHF" data-flag="ch"><span
                                        class="flag-icon flag-icon-ch"></span> CHF - Swiss Franc</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="CNY" data-flag="cn"><span
                                        class="flag-icon flag-icon-cn"></span> CNY - Chinese Yuan</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="HKD" data-flag="hk"><span
                                        class="flag-icon flag-icon-hk"></span> HKD - Hong Kong Dollar</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="NZD" data-flag="nz"><span
                                        class="flag-icon flag-icon-nz"></span> NZD - New Zealand Dollar</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="SEK" data-flag="se"><span
                                        class="flag-icon flag-icon-se"></span> SEK - Swedish Krona</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="KRW" data-flag="kr"><span
                                        class="flag-icon flag-icon-kr"></span> KRW - South Korean Won</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="SGD" data-flag="sg"><span
                                        class="flag-icon flag-icon-sg"></span> SGD - Singapore Dollar</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="NOK" data-flag="no"><span
                                        class="flag-icon flag-icon-no"></span> NOK - Norwegian Krone</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="MXN" data-flag="mx"><span
                                        class="flag-icon flag-icon-mx"></span> MXN - Mexican Peso</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="INR" data-flag="in"><span
                                        class="flag-icon flag-icon-in"></span> INR - Indian Rupee</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="RUB" data-flag="ru"><span
                                        class="flag-icon flag-icon-ru"></span> RUB - Russian Ruble</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="ZAR" data-flag="za"><span
                                        class="flag-icon flag-icon-za"></span> ZAR - South African Rand</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="TRY" data-flag="tr"><span
                                        class="flag-icon flag-icon-tr"></span> TRY - Turkish Lira</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="BRL" data-flag="br"><span
                                        class="flag-icon flag-icon-br"></span> BRL - Brazilian Real</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="THB" data-flag="th"><span
                                        class="flag-icon flag-icon-th"></span> THB - Thai Baht</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="AED" data-flag="ae"><span
                                        class="flag-icon flag-icon-ae"></span> AED - UAE Dirham</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="DKK" data-flag="dk"><span
                                        class="flag-icon flag-icon-dk"></span> DKK - Danish Krone</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="PLN" data-flag="pl"><span
                                        class="flag-icon flag-icon-pl"></span> PLN - Polish Złoty</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="IDR" data-flag="id"><span
                                        class="flag-icon flag-icon-id"></span> IDR - Indonesian Rupiah</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="ILS" data-flag="il"><span
                                        class="flag-icon flag-icon-il"></span> ILS - Israeli Shekel</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="PHP" data-flag="ph"><span
                                        class="flag-icon flag-icon-ph"></span> PHP - Philippine Peso</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="CZK" data-flag="cz"><span
                                        class="flag-icon flag-icon-cz"></span> CZK - Czech Koruna</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="RON" data-flag="ro"><span
                                        class="flag-icon flag-icon-ro"></span> RON - Romanian Leu</a></li>
                            <li><a class="dropdown-item" href="#" data-currency="HUF" data-flag="hu"><span
                                        class="flag-icon flag-icon-hu"></span> HUF - Hungarian Forint</a></li>
                        </ul>
                    </div>
                </div>

                <div class=" row d-inline-flex  bg-success-subtle border border-2 mb-3 border-success-subtle align-items-center py-4 rounded-2 px-3 mb-2"
                    role="alert">
                    <h3 class="primary_color_text" style="margin:0;">1 NPR = 0.0072 USD</h3>
                </div>

                <form action="{{ route('select_exchanger') }}" class="row justify-content-center">
                    <input type="hidden" name="base_currency" value="USD" id="base_currency">
                    <input type="hidden" name="target_currency" value="NPR" id="target_currency">
                    <div class="row mx-auto">
                        <input class="form-control primary_color_border w-50 m-auto" type="text" name="amount" value="1"
                            placeholder="Enter Amount">
                    </div>

                    <h1 class="my-2 primary_color_text fw-bold">$25 USD<span>*</span></h1>

                    <div class="bg-danger-subtle border border-2 border-danger-subtle py-1 mb-2 rounded-2 w-auto py-1">
                        <p class="primary_color_text m-0 fs-6">*Final amount may vary according to the exchanges.</p>
                    </div>
                    <div>
                        <button type="submit" class="btn primary_color_bg px-5 fs-5 mt-2 w-auto m-auto"
                            href="select-exchange.html">Send
                            Money</button>
                    </div>
                    <!-- <p class="mt-3 fs-5 fw-bolder">Exchange Rate: <span class="primary_color_text">1 NPR = USD
                                                    0.XXX</span> -->
                    </p>
                </form>




            </div>
        </div>
    </section>

    <!-- currency section end  -->

    <script>
        let base_currency = document.getElementById('base_currency');
        let target_currency = document.getElementById('target_currency');
        document.addEventListener("DOMContentLoaded", function() {
            // DOM Elements
            const fromCurrencyBtn = document.getElementById('fromCurrency');
            const toCurrencyBtn = document.getElementById('toCurrency');
            const amountInput = document.querySelector('input[name="amount"]');
            const rateDisplay = document.querySelector('.bg-success-subtle h3');
            const convertedAmountDisplay = document.querySelector('.primary_color_text.fw-bold');

            // Current exchange rates (with NPR/USD as base)
            let exchangeRate = 0.0075; // Default fallback rate (1 NPR = 0.0075 USD)
            const NPR_USD_RATE = 132.50; // 1 USD = 132.50 NPR (update this daily)
            let ratesCache = {}; // Cache for storing fetched rates

            // Function to update currency buttons
            function updateCurrencyButton(button, flagCode, currencyCode, isFromCurrency) {
                button.innerHTML = `
                <span class="flag-icon flag-icon-${flagCode}"></span>
                ${currencyCode}
            `;
                button.dataset.currency = currencyCode;
                button.dataset.flag = flagCode;
            }

            // Ensure one currency is NPR
            function validateCurrencySelection(changedDropdown) {
                const fromCurrency = fromCurrencyBtn.dataset.currency;
                const toCurrency = toCurrencyBtn.dataset.currency;

                if (fromCurrency !== "NPR" && toCurrency !== "NPR") {
                    console.log(changedDropdown)
                    if (changedDropdown === 'from') {
                        // Reset toCurrency to NPR
                        updateCurrencyButton(toCurrencyBtn, "np", "NPR", false);
                        target_currency.value = 'NPR';
                    } else {
                        // Reset fromCurrency to NPR
                        updateCurrencyButton(fromCurrencyBtn, "np", "NPR", true);
                        base_currency.value = 'NPR';
                    }
                    // alert("One currency must be NPR. The other currency has been reset to NPR.");
                }

                console.log(target_currency.value, base_currency.value)
            }

            // Fetch exchange rates from Frankfurter API
            async function fetchRates(baseCurrency) {
                try {
                    // Skip if we already have these rates
                    if (ratesCache[baseCurrency]) return ratesCache[baseCurrency];

                    const response = await fetch(`https://api.frankfurter.app/latest?from=${baseCurrency}`);
                    const data = await response.json();
                    ratesCache[baseCurrency] = data.rates;
                    return data.rates;
                } catch (error) {
                    console.error("Error fetching rates:", error);
                    return null;
                }
            }

            // Calculate and display exchange rate
            async function updateExchangeRate() {
                const fromCurrency = fromCurrencyBtn.dataset.currency;
                const toCurrency = toCurrencyBtn.dataset.currency;

                // Case 1: NPR to NPR
                if (fromCurrency === "NPR" && toCurrency === "NPR") {
                    exchangeRate = 1;
                    rateDisplay.textContent = `1 NPR = 1 NPR`;
                    calculateConvertedAmount();


                    return;
                }

                try {
                    // Case 2: NPR to Foreign Currency
                    if (fromCurrency === "NPR") {
                        const rates = await fetchRates("USD");
                        if (!rates) throw new Error("Failed to fetch USD rates");

                        // Convert NPR → USD → Target Currency
                        const usdToTargetRate = rates[toCurrency] || 1;
                        exchangeRate = (1 / NPR_USD_RATE) * usdToTargetRate;
                        rateDisplay.textContent = `1 NPR = ${exchangeRate.toFixed(6)} ${toCurrency}`;
                    }
                    // Case 3: Foreign Currency to NPR
                    else if (toCurrency === "NPR") {
                        const rates = await fetchRates(fromCurrency);
                        if (!rates) throw new Error("Failed to fetch rates");

                        // Convert From Currency → USD → NPR
                        const fromToUsdRate = rates.USD || 1;
                        exchangeRate = NPR_USD_RATE * fromToUsdRate;
                        rateDisplay.textContent = `1 ${fromCurrency} = ${exchangeRate.toFixed(2)} NPR`;
                    }
                    // Case 4: Foreign Currency to Foreign Currency
                    else {
                        const rates = await fetchRates(fromCurrency);
                        if (!rates) throw new Error("Failed to fetch rates");

                        exchangeRate = rates[toCurrency] || 1;
                        rateDisplay.textContent =
                        `1 ${fromCurrency} = ${exchangeRate.toFixed(4)} ${toCurrency}`;
                    }
                } catch (error) {
                    console.error("Exchange rate error:", error);
                    rateDisplay.textContent = "Using default rates (check connection)";
                    // Keep previous exchangeRate value
                }

                calculateConvertedAmount();
            }

            // Calculate converted amount
            function calculateConvertedAmount() {
                const amount = parseFloat(amountInput.value) || 0;
                const convertedAmount = amount * exchangeRate;
                const toCurrency = toCurrencyBtn.dataset.currency;

                if (toCurrency === "NPR") {
                    convertedAmountDisplay.innerHTML = `रु ${convertedAmount.toFixed(2)} NPR<span>*</span>`;
                } else {
                    convertedAmountDisplay.innerHTML = `${convertedAmount.toFixed(2)} ${toCurrency}<span>*</span>`;
                }
            }

            // Initialize currency buttons
            updateCurrencyButton(fromCurrencyBtn, "np", "NPR", true);
            updateCurrencyButton(toCurrencyBtn, "us", "USD", false);

            // Handle currency selection changes
            document.querySelectorAll(".dropdown-item").forEach((item) => {
                item.addEventListener("click", function(e) {
                    e.preventDefault();
                    const currency = this.dataset.currency;
                    const flag = this.dataset.flag;
                    const dropdown = this.closest(".dropdown");
                    const isFromCurrency = dropdown.id ===
                    "fromCurrencyDropdown";

                    updateCurrencyInput(currency, isFromCurrency);

                    updateCurrencyButton(
                        dropdown.querySelector(".dropdown-toggle"),
                        flag,
                        currency,
                        isFromCurrency
                    );

                    validateCurrencySelection(isFromCurrency ? 'from' : 'to');
                    updateExchangeRate();
                });
            });

            // Handle amount input changes
            amountInput.addEventListener("input", calculateConvertedAmount);

            // Initial rate update
            updateExchangeRate();

            // Update NPR rate daily (example using a simple timeout)
            setInterval(() => {
                // In a real app, you would fetch the latest NPR rate from NRB here
                console.log("Remember to update NPR_USD_RATE daily from NRB website");
            }, 24 * 60 * 60 * 1000);
        });

        function updateCurrencyInput(currency, isFromCurrency) {
            console.log(currency)
            if (isFromCurrency) {
                base_currency.value = currency;
            } else {
                target_currency.value = currency;
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to update button content
            function updateCurrencyButton(button, flagCode, currencyCode) {
                button.innerHTML = `
          <span class="flag-icon flag-icon-${flagCode}"></span>
          ${currencyCode}
      `;
            }

            // Handle clicks on dropdown items
            document.querySelectorAll(".dropdown-item").forEach((item) => {
                item.addEventListener("click", function(e) {
                    e.preventDefault();
                    const currency = this.dataset.currency;
                    const flag = this.dataset.flag;
                    const dropdownButton =
                        this.closest(".dropdown").querySelector(".dropdown-toggle");
                    updateCurrencyButton(dropdownButton, flag, currency);
                });
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

@endsection
