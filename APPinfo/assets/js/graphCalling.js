function graphCalling(graphid,timestamps,graphvar,graphtitle) {
    const ctx = document.getElementById(graphid);

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: timestamps,
      datasets: [{
        label: graphtitle,
        data: graphvar,
        borderWidth: 1
      }]
    },
      options: {
      scales: {
        y: {
          beginAtZero: true
        },
        
      }
    }
  });
}
