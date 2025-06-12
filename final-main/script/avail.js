
document.addEventListener('DOMContentLoaded', () => {
  console.log('Available Books page loaded');

  // Example: Toggle highlight status on click
  const rows = document.querySelectorAll('tbody tr');
  rows.forEach(row => {
    row.addEventListener('click', () => {
      row.classList.toggle('selected');
    });
  });
});
