var ctx = document.getElementById("myChart").getContext("2d");
var chart = new Chart(ctx, {
  // The type of chart we want to create
  type: "line", // also try bar or other graph types

  // The data for our dataset
  data: {
    labels: [
      "Jan 2019",
      "Feb 2019",
      "Mar 2019",
      "Apr 2019",
      "May 2019",
      "Jun 2019",
      "Jul 2019",
      "Jan 2020",
      "Feb 2020",
      "Mar 2020",
      "Apr 2020",
      "May 2020",
      "Jun 2020",
      "Jul 2020",
      "Aug 2020",
      "Sep 2020",
      "Oct 2020",
      "Nov 2020",
      "Dec 2020",
      "Jan 2021",
      "Feb 2021",
      "Mar 2021",
      "Apr 2021",
      "May 2021",
      "Jun 2021",
    ],
    // Information about the dataset
    datasets: [
      {
        label: "Jumlah Banjir yang Terjadi",
        borderColor: "#f8c000",
        data: [
          104, 124, 134, 171, 34, 64, 11, 126, 146, 88, 81, 101, 78, 80, 23, 68,
          66, 91, 111, 171, 127, 119, 72, 80, 33,
        ],
      },
    ],
  },

  // Configuration options
  options: {
    layout: {
      padding: 10,
    },
    legend: {
      position: "bottom",
    },
    title: {
      display: true,
      text: "Data Banjir yang Terjadi di Indonesia 2019-2021",
    },
    scales: {
      yAxes: [
        {
          scaleLabel: {
            display: true,
            labelString: "Jumlah banjir",
          },
        },
      ],
      xAxes: [
        {
          scaleLabel: {
            display: false,
            labelString: "Month of the Year",
          },
        },
      ],
    },
  },
});
