
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('addBookForm');
  form.addEventListener('submit', function(event) {
    event.preventDefault();
    alert("Book added successfully!");
    this.reset();
  });
});
