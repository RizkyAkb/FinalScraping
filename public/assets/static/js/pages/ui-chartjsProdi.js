var chartColors = {
  red: "rgb(255, 99, 132)",
  orange: "rgb(255, 159, 64)",
  yellow: "rgb(255, 205, 86)",
  green: "rgb(75, 192, 192)",
  info: "#41B1F9",
  blue: "#3245D1",
  purple: "rgb(153, 102, 255)",
  grey: "#EBEFF6",
}

var ctxBar = document.getElementById("prodi").getContext("2d")
var myBar = new Chart(ctxBar, {
  type: "bar",
  data: {
    labels: ["2017", "2018", "2019", "2020", "2021", "2022", "2023","2024"],
    datasets: [
      {
        label: "Sitasi",
        backgroundColor: [
          chartColors.grey,
          chartColors.grey,
          chartColors.grey,
          chartColors.grey,
          chartColors.info,
          chartColors.blue,
          chartColors.grey,
        ],
        data: [31, 13, 13, 23, 31, 13, 11, 53],
      },
    ],
  },
  options: {
    responsive: true,
    barRoundness: 1,
    title: {
      display: true,
      text: "Perbandingan Sitasi Artikel Dosen dari Tahun ke Tahun",
    },
    legend: {
      display: false,
    },
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: true,
            suggestedMax: 40 + 20,
            padding: 10,
          },
          gridLines: {
            drawBorder: false,
          },
        },
      ],
      xAxes: [
        {
          gridLines: {
            display: false,
            drawBorder: false,
          },
        },
      ],
    },
  },
})