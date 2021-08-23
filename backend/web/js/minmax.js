new Vue({
  el: "#minmaxForm",
  data: function () {
    return {
      min_build_year: 0,
      max_build_year: 0,
    };
  },
  computed: {
    build_year: function () {
      this.max_build_year = this.getValidatedMax(
        this.min_build_year,
        this.max_build_year
      );
      return this.min_build_year + "-" + this.max_build_year;
    },
  },
  methods: {
    getValidatedMax: function (min, max) {
      return min > max ? min + 1 : max;
    },
  },
});
