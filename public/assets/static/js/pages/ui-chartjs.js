var ctxBar = document.getElementById("universitas").getContext("2d");

// Ambil data dari endpoint Laravel
fetch("/chart-data")
  .then(response => response.json())
  .then(data => {
    var myBar = new Chart(ctxBar, {
      type: "bar",
      data: {
        labels: data.labels, // Gunakan data labels dari controller
        datasets: [
          {
            label: "Jumlah Publikasi",
            backgroundColor: data.labels.map(() => "rgba(75, 192, 192, 0.6)"),
            borderColor: data.labels.map(() => "rgba(75, 192, 192, 1)"),
            borderWidth: 1,
            data: data.data, // Gunakan data count dari controller
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: "Jumlah Publikasi per Tahun"
          },
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      },
    });
  })
  .catch(error => console.error("Error fetching chart data:", error));
