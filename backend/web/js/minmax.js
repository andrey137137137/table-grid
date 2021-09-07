var inputs = [
  {
    name: "build_year",
    min: 2006,
    max: 2021,
  },
  {
    name: "dwt",
    min: 0,
    max: 100000,
  },
  {
    name: "contract_duration",
    min: 2,
    max: 9,
  },
  {
    name: "salary",
    min: 100,
    max: 99999,
  },
];
var dataProps = {
  minPrefix: "min_",
  maxPrefix: "max_",
  currency: "USD",
};
var computedProps = {};

function getPrefixedName(inputName, prefix) {
  prefix = prefix ? dataProps.maxPrefix : dataProps.minPrefix;
  return prefix + inputName;
}

function getComputedProp(inputName, postfix) {
  postfix = postfix || "";
  return {
    get: function () {
      this[getPrefixedName(inputName, true)] = this.getValidatedMax(
        this[getPrefixedName(inputName)],
        this[getPrefixedName(inputName, true)]
      );
      return this.getResultString(
        this[getPrefixedName(inputName)],
        this[getPrefixedName(inputName, true)],
        inputName == "salary" ? this.currency : postfix
      );
    },
    set: function (newValue) {
      this.setMinMax(inputName, newValue);
    },
  };
}

inputs.forEach(function (obj) {
  var inputName = obj.name;
  dataProps[getPrefixedName(inputName)] = obj.min;
  dataProps[getPrefixedName(inputName, true)] = obj.max;
  computedProps[inputName] = getComputedProp(
    inputName,
    inputName == "contract_duration" ? "months" : ""
  );
});

console.log(dataProps);
console.log(computedProps);

new Vue({
  el: "#minmaxForm",
  data: function () {
    return dataProps;
  },
  computed: computedProps,
  methods: {
    getValidatedMax: function (min, max) {
      return min > max ? min + 1 : max;
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
          var rest = array[length - 1].trim().split(" ");

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
    var $vm = this;
    inputs.forEach(function (obj) {
      $vm.setMinMax(obj.name);
    });
  },
});
