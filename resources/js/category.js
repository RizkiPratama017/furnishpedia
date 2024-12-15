// console.log('Category.js loaded successfully');


const name_category = document.querySelector("#name");
const slug = document.querySelector("#slug");

name_category.addEventListener('change', function() {
    fetch('dashboard-category/checkSlug?name=' + name_category.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug);
});

title.addEventListener("keyup", function() {
    let preslug = title.value;
    preslug = preslug.replace(/[^a-zA-Z0-9]+/g, '-'); // Replace non-alphanumeric characters with '-'
    slug.value = preslug.toLowerCase();
});

document.addEventListener("trix-file-accept", function(e) {
    e.preventDefault();
});

document.addEventListener("trix-initialize", function() {
    const fileButtonGroup = document.querySelector("[data-trix-button-group='file']");
    if (fileButtonGroup) {
        fileButtonGroup.style.display = "none";
    }
});