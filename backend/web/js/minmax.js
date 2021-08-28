new Vue({
  el: "#minmaxForm",
  data: function () {
    return {
      minPrefix: "min_",
      maxPrefix: "max_",
      min_build_year: 2015,
      max_build_year: 2021,
      min_dwt: 0,
      max_dwt: 100000,
      min_contract_duration: 1,
      max_contract_duration: 9,
      min_salary: 100,
      max_salary: 99999,
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
    getSplitInputValue: function (str, index) {
      var array = str.split("-");

      switch (index) {
        case 0:
          return array[0].trim();
        default:
          var rest = array[1].split(" ");

          if (index == 1) {
            return rest[0].trim();
          }

          return rest[1].trim();
      }
    },
    setCounter: function (inputName, inputValue, splitIndex = 0) {
      var counterPrefix = !splitIndex ? this.minPrefix : this.maxPrefix;

      if (inputValue) {
        this[counterPrefix + inputName] = this.getSplitInputValue(
          inputValue,
          splitIndex
        );

        if (inputName == "salary" && splitIndex) {
          this.currency = this.getSplitInputValue(inputValue, 2);
        }
      } else if (splitIndex) {
        this[this.maxPrefix + inputName] = this.getValidatedMax(
          this[this.minPrefix + inputName],
          this[this.maxPrefix + inputName]
        );
      }
    },
    setMinMax: function (inputName) {
      var inputValue = this.$refs[inputName].dataset.value;
      console.log(inputValue);
      var minVarName = this.minPrefix + inputName;
      var maxVarName = this.maxPrefix + inputName;
      var $minEl = this.$refs[minVarName];
      var $maxEl = this.$refs[maxVarName];
      this.setCounter(inputName, inputValue);
      this.setCounter(inputName, inputValue, 1);
      $minEl.min = this[minVarName];
      $minEl.max = this[maxVarName];
      $maxEl.min = this[minVarName];
      $maxEl.max = this[maxVarName];
    },
  },
  mounted() {
    this.setMinMax("build_year");
    this.setMinMax("dwt");
    this.setMinMax("contract_duration");
    this.setMinMax("salary");
  },
});
