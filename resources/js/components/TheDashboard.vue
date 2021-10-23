<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Cards -->

        <div class="row">
          <div
            class="col-lg-3 col-6"
            v-for="(item, key) in dashboardCards"
            :key="key"
          >
            <div class="small-box" :class="item.class">
              <div class="inner">
                <h3>{{ item.heading }}</h3>
                <p>{{ item.info }}</p>
              </div>
              <div class="icon">
                <i :class="item.icon"></i>
              </div>
              <a href="#" class="small-box-footer"
                >More info <i class="fas fa-arrow-circle-right"></i
              ></a>
            </div>
          </div>
        </div>
        <!-- End of Cards -->
        <!-- Charts -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card shadow">
              <div class="card-body">
                <apexchart
                  type="line"
                  width="500"
                  :options="chartOptionsLine"
                  :series="seriesLine"
                />
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="card shadow">
              <div class="card-body">
                <apexchart
                  type="area"
                  width="500"
                  :options="chartOptionsArea"
                  :series="seriesArea"
                />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card shaow">
              <div class="card-body">
                <apexchart
                  type="bar"
                  width="500"
                  :options="chartOptionsColumn"
                  :series="seriesColumn"
                />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card shadow">
              <div class="card-body">
                <apexchart
                  type="bar"
                  width="500"
                  :options="chartOptionsBar"
                  :series="seriesBar"
                />
              </div>
            </div>
          </div>
          <!-- END VueApexChart -->
        </div>
        <!-- End of Charts -->
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dashboardCards: [
        {
          id: 1,
          class: "bg-info",
          heading: "150",
          info: "New Orders",
          icon: "fas fa-shopping-bag",
        },
        {
          id: 2,
          class: "bg-success",
          heading: "53%",
          info: "Bounce Rate",
          icon: "fas fa-chart-bar",
        },
        {
          id: 3,
          class: "bg-warning",
          heading: "44",
          info: "User Registrations",
          icon: "fas fa-user-plus",
        },
        {
          id: 4,
          class: "bg-danger",
          heading: "65",
          info: "Unique Visitors",
          icon: "fas fa-chart-pie",
        },
      ],

      seriesLine: [
        {
          name: "Desktops",
          data: [10, 41, 35, 51, 49, 62, 69, 91, 148],
        },
      ],
      chartOptionsLine: {
        chart: {
          height: "auto",
          zoom: {
            enabled: false,
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: "straight",
        },
        title: {
          text: "Product Trends by Month",
          align: "left",
        },
        grid: {
          row: {
            colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
            opacity: 0.5,
          },
        },
        xaxis: {
          categories: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
          ],
        },
      },
      // SPLINE AREA
      seriesArea: [
        {
          name: "series1",
          data: [31, 40, 28, 51, 42, 109, 100],
        },
        {
          name: "series2",
          data: [11, 32, 45, 32, 34, 52, 41],
        },
      ],
      chartOptionsArea: {
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: "smooth",
        },
        xaxis: {
          type: "datetime",
          categories: [
            "2018-09-19T00:00:00",
            "2018-09-19T01:30:00",
            "2018-09-19T02:30:00",
            "2018-09-19T03:30:00",
            "2018-09-19T04:30:00",
            "2018-09-19T05:30:00",
            "2018-09-19T06:30:00",
          ],
        },
        tooltip: {
          x: {
            format: "dd/MM/yy HH:mm",
          },
        },
      },
      seriesColumn: [
        {
          name: "Net Profit",
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
        },
        {
          name: "Revenue",
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
        },
        {
          name: "Free Cash Flow",
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
        },
      ],
      chartOptionsColumn: {
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "55%",
            endingShape: "rounded",
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: true,
          width: 2,
          colors: ["transparent"],
        },
        xaxis: {
          categories: [
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
          ],
        },
        yaxis: {
          title: {
            text: "$ (thousands)",
          },
        },
        fill: {
          opacity: 1,
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands";
            },
          },
        },
      },
      seriesBar: [
        {
          data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380],
        },
      ],
      chartOptionsBar: {
        plotOptions: {
          bar: {
            horizontal: true,
          },
        },
        dataLabels: {
          enabled: false,
        },
        xaxis: {
          categories: [
            "South Korea",
            "Canada",
            "United Kingdom",
            "Netherlands",
            "Italy",
            "France",
            "Japan",
            "United States",
            "China",
            "Germany",
          ],
        },
      },
    };
  },
};
</script>

<style lang="scss" scoped>
</style> 