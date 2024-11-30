const barChartCtx = document.getElementById("bar-chart").getContext("2d");
const lineChartCtx = document.getElementById("line-chart").getContext("2d");
let barChart, lineChart;

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
        labels: Object.keys(data.history),
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
        labels: Object.keys(data.history),
        datasets: [
          {
            label: "Daily Completion",
            data: Object.values(data.history).map((item) => item.completed),
            borderColor: "blue",
            fill: false,
          },
        ],
      };

      if (barChart) barChart.destroy();
      barChart = new Chart(barChartCtx, {
        type: "bar",
        data: barData,
      });

      if (lineChart) lineChart.destroy();
      lineChart = new Chart(lineChartCtx, {
        type: "line",
        data: lineData,
      });
    });
};

document.querySelectorAll(".category-btn").forEach((button) => {
  button.addEventListener("click", () => {
    const category = button.dataset.category;
    fetchData(category);
  });
});

fetchData("meditation");
