<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- Glide.js CSS -->
    <link rel="stylesheet" href="node_modules/@glidejs/glide/dist/css/glide.core.min.css">

    {{-- openAPI --}}
    <link href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" rel="stylesheet" />

    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/heroicons@1.0.6/dist/heroicons.js"></script>

    <style>
        #results {
            max-height: 300px;
            overflow-y: auto;
            position: absolute;
            z-index: 1000;
            background-color: white;
            width: 100%;
        }

        #search-suggestions {
            max-height: 200px;
            /* Batasi tinggi agar tidak terlalu panjang */
            overflow-y: auto;
        }

        #search-suggestions div {
            padding: 8px;
            cursor: pointer;
        }

        #search-suggestions div:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body class="h-full m-0">

    <div class="h-screen">

        <main class="h-screen">
            {{ $slot }}
        </main>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            let query = this.value;
            if (query.length > 1) {
                fetch('/search/suggestions?q=' + query)
                    .then(response => response.json())
                    .then(data => {
                        let suggestionsDiv = document.getElementById('search-suggestions');
                        suggestionsDiv.innerHTML = '';
                        if (data.length > 0) {
                            suggestionsDiv.classList.remove('hidden');
                            data.forEach((item, index) => {
                                let suggestionItem = document.createElement('div');
                                suggestionItem.classList.add('p-2', 'cursor-pointer',
                                    'hover:bg-gray-200');
                                suggestionItem.innerHTML = item.name;
                                suggestionItem.dataset.id = item
                                    .id;
                                suggestionItem.onclick = () => {

                                    document.getElementById('search').value = item.name;
                                    performSearch(item.id, item
                                        .name);
                                };
                                suggestionsDiv.appendChild(suggestionItem);
                            });
                            setFocusOnSuggestion(0);
                        } else {
                            suggestionsDiv.classList.add('hidden');
                        }
                    })
                    .catch(error => console.error('Error fetching suggestions:', error));
            } else {
                document.getElementById('search-suggestions').classList.add('hidden');
            }
        });

        let selectedIndex = -1;


        document.getElementById('search').addEventListener('keydown', function(event) {
            let suggestions = document.querySelectorAll('#search-suggestions div');

            if (event.key === 'ArrowDown') {
                if (selectedIndex < suggestions.length - 1) {
                    selectedIndex++;
                    setFocusOnSuggestion(selectedIndex);
                }
            } else if (event.key === 'ArrowUp') {
                if (selectedIndex > 0) {
                    selectedIndex--;
                    setFocusOnSuggestion(selectedIndex);
                }
            } else if (event.key === 'Enter') {
                if (selectedIndex !== -1) {
                    let selectedItem = suggestions[selectedIndex];

                    document.getElementById('search').value = selectedItem.innerText;
                    performSearch(selectedItem.dataset.id, selectedItem
                        .innerText);
                }
            }
        });


        function setFocusOnSuggestion(index) {
            let suggestions = document.querySelectorAll('#search-suggestions div');
            suggestions.forEach((suggestion, i) => {
                if (i === index) {
                    suggestion.classList.add('bg-gray-200');
                } else {
                    suggestion.classList.remove('bg-gray-200');
                }
            });
        }


        function performSearch(id, name) {

            window.location.href = '/products/' + id;
        }


        document.getElementById('search').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                window.location.href = '/search?q=' + this.value;
            }
        });
    </script>

    <!-- Flowbite JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <!-- Glide.js JavaScript -->
    <script src="node_modules/@glidejs/glide/dist/glide.min.js"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
