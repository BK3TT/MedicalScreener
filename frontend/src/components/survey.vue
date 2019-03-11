<template>
    <div :id="'theme-' + this.$route.name" class="container">
        <form id="form-survey" @submit="saveSurvey">
            <div class="tab" v-bind:class="{ active: counterTab == 0 }">
                <p><strong>Q1</strong> Do you suffer from back problems?</p>
                <label>
                    <span class='label-title'>No</span>
                    <input type="radio" checked="checked" name="answer-1" value="0">
                    <span class="checkmark"></span>
                </label>
                <label>
                    <span class='label-title'>Yes</span>
                    <input type="radio" name="answer-1" value="1">
                    <span class="checkmark"></span>
                </label>
                <input type="hidden" name="question-1" value="Do you suffer from back problems?">
            </div>
            <div class="tab" v-bind:class="{ active: counterTab == 1 }">
                <p><strong>Q2</strong> Are you on any medication?</p>
                <label>
                    <span class='label-title'>No</span>
                    <input type="radio" checked="checked" name="answer-2" value="2">
                    <span class="checkmark"></span>
                </label>
                <label>
                    <span class='label-title'>Yes</span>
                    <input type="radio" name="answer-2" value="1">
                    <span class="checkmark"></span>
                </label>
                <input type="hidden" name="question-2" value="Are you on any medication?">
            </div>
            <div class="tab" v-bind:class="{ active: counterTab == 2 }">
                <p><strong>Q3</strong> Have any of your family members got any types of cancer?</p>
                <label>
                    <span class='label-title'>No</span>
                    <input type="radio" checked="checked" name="answer-3" value="0">
                    <span class="checkmark"></span>
                </label>
                <label>
                    <span class='label-title'>Yes</span>
                    <input type="radio" name="answer-3" value="1">
                    <span class="checkmark"></span>
                </label>
                <input type="hidden" name="question-3" value="Are you on any medication?">
            </div>
            <div class="tab" v-bind:class="{ active: counterTab == 3 }">
                <p><strong>Q4</strong> Have you been checked for high blood pressure?</p>
                <label>
                    <span class='label-title'>No</span>
                    <input type="radio" checked="checked" name="answer-4" value="0">
                    <span class="checkmark"></span>
                </label>
                <label>
                    <span class='label-title'>Yes</span>
                    <input type="radio" name="answer-4" value="1">
                    <span class="checkmark"></span>
                </label>
                <input type="hidden" name="question-4" value="Have you been checked for high blood pressure?">
            </div>
            <div class="tab" v-bind:class="{ active: counterTab == 4 }">
                <p><strong>Q5</strong> How many times do you exercise a week?</p>
                <label>
                    <span class='label-title'>0</span>
                    <input type="radio" checked="checked" name="answer-5" value="0">
                    <span class="checkmark"></span>
                </label>
                <label>
                    <span class='label-title'>1</span>
                    <input type="radio" name="answer-5" value="1">
                    <span class="checkmark"></span>
                </label>
                <label>
                    <span class='label-title'>2</span>
                    <input type="radio" name="answer-5" value="2">
                    <span class="checkmark"></span>
                </label>
                <label>
                    <span class='label-title'>More than 2 times a week</span>
                    <input type="radio" name="answer-5" value="3">
                    <span class="checkmark"></span>
                </label>
                <input type="hidden" name="question-5" value="How many times do you exercise a week?">
            </div>
            <div class="action-buttons">
                <button type="button" id="prevBtn" v-show="counterTab > 0" v-on:click="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" v-on:click="nextPrev(1)">Next</button>
                <button type="submit" id="submitBtn">Submit</button>
            </div>
            <div style="text-align:center;margin-top:40px;">
                <span class="step" v-bind:class="{ active: counterTab == 0 }"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>
            <template v-if="this.$session.get('id')">
              <input type="hidden" name='user_id' :value="this.$session.get('id')" />
            </template>
        </form>
    </div>
</template>

<script>
export default {
  name: 'survey',
  data () {
    return {
      counterTab: 0,
      tabCount: 5
    }
  },
  methods: {
    nextPrev: function (counter) {
      let x = window.$('.tab')

      this.$data.counterTab = this.$data.counterTab + counter

      this.fixStepIndicator(this.$data.counterTab)

      if (this.$data.counterTab === (x.length - 1)) {
        window.$('#nextBtn').hide()
        window.$('#submitBtn').show()
      } else {
        window.$('#nextBtn').show()
        window.$('#submitBtn').hide()
      }
    },
    fixStepIndicator: function (counter) {
      let i
      let step = window.$('.step')

      for (i = 0; i < step.length; i++) {
        window.$(step[i]).removeClass('active')
      }

      window.$(step[counter]).addClass('active')
    },
    saveSurvey: function (e) {
      e.preventDefault()
      let that = this
      this.$http({
        method: 'post',
        url: 'http://localhost/api/survey/save',
        data: window.$('#form-survey').serialize(),
        config: {
          headers: { 'Content-Type': 'multipart/form-data' }
        }
      })
        .then(function (response) {
          console.log(response)
          if (response.status === 200) {
            that.$router.push('/completion')
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  }
}
</script>
