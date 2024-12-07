const barChartCtx = document.getElementById("bar-chart").getContext("2d");
const lineChartCtx = document.getElementById("line-chart").getContext("2d");
let barChart, lineChart;

const formatDate = (dateString) => {
  const date = new Date(dateString);
  const month = date.getMonth() + 1;
  const day = date.getDate();
  return `${month}-${day}`;
};

const fetchData = (category) => {
  fetch(`/analytics/data?category=${category}`)
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("completion-rate").innerText =
        ((data.completed / data.total) * 100).toFixed(2) + "%";
      document.getElementById("total").innerText = data.total;
      document.getElementById("completed").innerText = data.completed;
      document.getElementById("ongoing").innerText = data.ongoing;

      const barData = {
        labels: Object.keys(data.history).map(formatDate),
        datasets: [
          {
            label: "Completed",
            data: Object.values(data.history).map((item) => item.completed),
            backgroundColor: "green",
          },
          {
            label: "Ongoing",
            data: Object.values(data.history).map((item) => item.ongoing),
            backgroundColor: "orange",
          },
        ],
      };

      const lineData = {
        labels: Object.keys(data.history).map(formatDate),
        datasets: [
          {
            label: "Daily Completion",
            data: Object.values(data.history).map((item) => item.completed),
            borderColor: "white",
            fill: false,
          },
        ],
      };

      if (barChart) barChart.destroy();
      barChart = new Chart(barChartCtx, {
        type: "bar",
        data: barData,
        options: {
          scales: {
            x: {
              ticks: {
                font: {
                  size: 14,
                  family: "Arial",
                  weight: "bold",
                },
                color: "#f0f0f0",
              },
              title: {
                display: true,
                text: "Date Added",
                font: {
                  size: 16,
                  family: "Arial",
                  weight: "bold",
                },
                color: "#ffffff",
              },
              grid: {
                display: false,
              },
              borderColor: "white",
              borderWidth: 2,
            },
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 1,
                font: {
                  size: 14,
                  family: "Arial",
                  weight: "bold",
                },
                color: "#f0f0f0",
              },
              title: {
                display: true,
                text: "Total Completion",
                font: {
                  size: 16,
                  family: "Arial",
                  weight: "bold",
                },
                color: "#ffffff",
              },
              grid: {
                display: false,
              },
              borderColor: "white",
              borderWidth: 2,
            },
          },
          plugins: {
            tooltip: {
              callbacks: {
                label: function (context) {
                  const dateParts = context.label.split("-");
                  const year = 2024;
                  const formattedDate = `${year}-${dateParts[0].padStart(
                    2,
                    "0"
                  )}-${dateParts[1].padStart(2, "0")}`;

                  const completedData = data.history[formattedDate];

                  if (!completedData) {
                    return [`No data available for ${context.label}`];
                  }

                  const completed = context.dataset.data[context.dataIndex];
                  const ongoing =
                    context.datasetIndex === 0
                      ? completedData.ongoing
                      : completedData.completed;

                  return [
                    `${context.dataset.label}: ${context.raw}`,
                    `Completed: ${completed}`,
                    `Ongoing: ${ongoing}`,
                  ];
                },
              },
            },
          },
        },
      });

      if (lineChart) lineChart.destroy();
      lineChart = new Chart(lineChartCtx, {
        type: "line",
        data: lineData,
        options: {
          scales: {
            x: {
              ticks: {
                font: {
                  size: 14,
                  family: "Arial",
                  weight: "bold",
                },
                color: "#f0f0f0",
              },
              title: {
                display: true,
                text: "Date",
                font: {
                  size: 16,
                  family: "Arial",
                  weight: "bold",
                },
                color: "#ffffff",
              },
              grid: {
                display: false,
              },
              borderColor: "white",
              borderWidth: 2,
            },
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 1,
                font: {
                  size: 14,
                  family: "Arial",
                  weight: "bold",
                },
                color: "#f0f0f0",
              },
              title: {
                display: true,
                text: "Total Completion",
                font: {
                  size: 16,
                  family: "Arial",
                  weight: "bold",
                },
                color: "#ffffff",
              },
              grid: {
                display: false,
              },
              borderColor: "white",
              borderWidth: 2,
            },
          },
        },
      });
    });
};

document.querySelectorAll(".category-btn").forEach((button) => {
  button.addEventListener("click", () => {
    document.querySelectorAll(".category-btn").forEach((btn) => {
      btn.classList.remove("active");
    });

    button.classList.add("active");

    const category = button.dataset.category;
    fetchData(category);
  });
});

fetchData("meditation");
