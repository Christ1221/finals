// dashboard.js

function editMember(id) {
  alert('Edit member with ID: ' + id);
}

function deleteMember(id) {
  if (confirm('Are you sure you want to delete member with ID: ' + id + '?')) {
    alert('Member with ID ' + id + ' deleted.');
  }
}

window.addEventListener('load', () => {
  const ctx = document.getElementById('dashboardChart').getContext('2d');
  window.dashboardChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Books Issued',
        data: [65, 59, 80, 81, 56, 55],
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1,
        borderRadius: 5
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true, ticks: { stepSize: 20 } }
      }
    }
  });

  setInterval(() => {
    fetch('/api/dashboard-stats')
      .then(r => r.json())
      .then(data => {
        document.querySelector('.card.yellow strong').textContent = data.loggedInUsers;
        document.querySelector('.card.red strong').textContent = data.totalBooks;
        document.querySelector('.card.green strong').textContent = data.totalMembers;
        document.querySelector('.card.blue strong').textContent = data.activeUsers;
        dashboardChart.data.datasets[0].data = data.booksIssued;
        dashboardChart.update();
      });
  }, 60000);
});
