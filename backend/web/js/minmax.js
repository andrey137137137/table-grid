new Vue({
  el: "#minmaxForm",
  data: function () {
    return {
      min_build_year: 0,
      max_build_year: 0,
      min_dwt: 0,
      max_dwt: 0,
      min_contract_duration: 0,
      max_contract_duration: 0,
      min_salary: 0,
      max_salary: 0,
      currency: "USD",
    };
  },
  computed: {
    build_year: function () {
      this.max_build_year = this.getValidatedMax(
        this.min_build_year,
        this.max_build_year
      );
      return this.getResultString(this.min_build_year, this.max_build_year);
    },
    dwt: function () {
      this.max_dwt = this.getValidatedMax(this.min_dwt, this.max_dwt);
      return this.getResultString(this.min_dwt, this.max_dwt);
    },
    contract_duration: function () {
      this.max_contract_duration = this.getValidatedMax(
        this.min_contract_duration,
        this.max_contract_duration
      );
      return this.getResultString(
        this.min_contract_duration,
        this.max_contract_duration,
        "months"
      );
    },
    salary: function () {
      this.max_salary = this.getValidatedMax(this.min_salary, this.max_salary);
      return this.getResultString(
        this.min_salary,
        this.max_salary,
        this.currency
      );
    },
  },
  methods: {
    getValidatedMax: function (min, max) {
      return min > max ? min + 1 : max;
    },
    getResultString: function (min, max, measure = "") {
      return min + "-" + max + (measure ? " " + measure : "");
    },
  },
});
