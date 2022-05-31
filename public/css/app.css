require('./bootstrap');

import Vue from 'vue/dist/vue.js';

new Vue({
    el: "#app",
    data(){
      return {
          content: {
              title: null,
              id: null,
          },
          questions:[],
          user_answers:[],
      }
    },
    methods:{
        selectContent(id, title){
            this.content = {
                title: title,
                id: id
            };

            fetch('/api/questions/get_question_answers/'+id).then(data => data.json()).then(data => {
                this.questions = data.data
            })
        },
        changeAnswer(qIndex, value){
            if(this.user_answers[qIndex] === undefined){
                this.user_answers.push(value);
            } else {
                this.user_answers[qIndex] = value
            }
        },
        checkAnswer(){
            fetch("/api/questions/check_answer/",{
                method: "POST",
                body: JSON.stringify({
                    content_id: this.content.id,
                    answer_ids: this.user_answers,
                })
            }).then(res => res.json()).then(data => {
                if(data.success){
                    //window.location.reload();
                }
            })
        }
    },
})
