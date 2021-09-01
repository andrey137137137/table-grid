new Vue({
  el: "#minmaxForm",
  data: function () {
    return {
      minPrefix: "min_",
      maxPrefix: "max_",
      min_build_year: 2006,
      max_build_year: 2021,
      min_dwt: 0,
      max_dwt: 100000,
      min_contract_duration: 2,
      max_contract_duration: 9,
      min_salary: 100,
      max_salary: 99999,
      currency: "USD",
    };
  },
  computed: {
    build_year: {
      get: function () {
        this.max_build_year = this.getValidatedMax(
          this.min_build_year,
          this.max_build_year
        );
        return this.getResultString(this.min_build_year, this.max_build_year);
      },
      set: function (newValue) {
        this.setMinMax("build_year", newValue);
      },
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
      // return min > max ? Number(min) + 1 : max;
    },
    getResultString: function (min, max, measure = "") {
      var minMaxStr = min == max ? min : min + "-" + max;
      var measureStr = measure ? " " + measure : "";
      return minMaxStr + measureStr;
    },
    getCounterValue: function (str, toNumber = true) {
      str = str.trim();

      if (!toNumber) {
        return str;
      }

      return Number(str);
    },
    getSplitInputValue: function (str, index) {
      var array = str.split("-");
      var length = array.length;

      if (length == 1) {
        index = 1;
      }

      switch (index) {
        case 0:
          return this.getCounterValue(array[0]);
        default:
          var rest = array[length - 1].split(" ");

          if (index == 1) {
            return this.getCounterValue(rest[0]);
          }

          return this.getCounterValue(rest[1], false);
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
        // } else if (splitIndex) {
        //   this[this.maxPrefix + inputName] = this.getValidatedMax(
        //     this[this.minPrefix + inputName],
        //     this[this.maxPrefix + inputName]
        //   );
      }
    },
    setBorders: function (inputName) {
      var minVarName = this.minPrefix + inputName;
      var maxVarName = this.maxPrefix + inputName;
      var $minEl = this.$refs[minVarName];
      var $maxEl = this.$refs[maxVarName];
      $minEl.min = this[minVarName];
      $minEl.max = this[maxVarName];
      $maxEl.min = this[minVarName];
      $maxEl.max = this[maxVarName];
    },
    setMinMax: function (inputName, inputValue) {
      if (!inputValue) {
        this.setBorders(inputName);
      }

      inputValue = inputValue || this.$refs[inputName].dataset.value;
      console.log(inputValue);

      if (inputValue) {
        this.setCounter(inputName, inputValue);
        this.setCounter(inputName, inputValue, 1);
      }
    },
  },
  mounted() {
    this.setMinMax("build_year");
    this.setMinMax("dwt");
    this.setMinMax("contract_duration");
    this.setMinMax("salary");
  },
});
