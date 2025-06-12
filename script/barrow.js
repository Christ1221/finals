
document.addEventListener('DOMContentLoaded', () => {
  function borrowBook(button) {
    const row = button.closest('tr');
    const statusCell = row.querySelector('td:nth-child(5)');
    const actionCell = row.querySelector('td:nth-child(6)');
    statusCell.innerHTML = '<span class="borrowed">Borrowed</span>';
    actionCell.textContent = '📚 Borrowed';
  }

  document.querySelectorAll('.borrow-btn').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      borrowBook(btn);
    });
  });
});
