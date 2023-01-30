/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
// import './bootstrap';
require('bootstrap');

const $ = require('jquery');

$(document).ready(function () {
  $('[data-toggle="popover"]').popover();
});

import Sortable from 'sortablejs';

new Sortable(document.getElementById('quiz_quizQuestions'), {
  group: 'shared',
  animation: 150,
  onAdd: function (e) {
    const sequence = e.newIndex;
    let itemOrder = e.item.dataset.itemOrder;

    e.item.innerHTML = `
    ${e.item.innerText}
    <fieldset class="mb-3">
      <div id="quiz_quizQuestions_${itemOrder}">
        <input 
            type="hidden"
            id="quiz_quizQuestions_${itemOrder}_sequence"
            name="quiz[quizQuestions][${itemOrder}][sequence]"
            value="${sequence}"
            class="sequence"
        > 
        <input 
            type="hidden"
            id="quiz_quizQuestions_${itemOrder}_question"
            name="quiz[quizQuestions][${itemOrder}][question]"
            value="${e.item.dataset.questionId}"
            class="question"
        >
      </div>
    </fieldset>
    `
  },
  onRemove: function (e) {
    e.item.innerHTML = e.item.innerText;
  },
  onSort: function (e) {
    const sequences = document.querySelectorAll('.sequence');

    sequences.forEach((el, i) => {
      el.setAttribute('value', i);
    });
  }
});

new Sortable(document.getElementById('questions'), {
  group: 'shared',
  animation: 150,
});
