// wait until DOM is ready
document.addEventListener("DOMContentLoaded", () => {
	//wait until images, links, fonts, stylesheets, and js is loaded
	window.addEventListener("load", () => {

        if (document.body.classList.contains("page-template-page-gut-zu-wissen")) {
            const faqQuestions = document.querySelectorAll('.faq-question');
        
            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    const icon = this.querySelector('.icon-plus');
                    const isOpen = answer.classList.contains('open');
                    
                    // Close all other answers
                    document.querySelectorAll('.faq-answer').forEach(el => {
                        el.classList.remove('open');
                        el.previousElementSibling.classList.add('q-closed');
                    });
                    document.querySelectorAll('.icon-plus').forEach(icon => icon.textContent = '+');
        
                    // Toggle the current answer
                    if (!isOpen) {
                        question.classList.remove('q-closed');
                        answer.classList.add('open');
                        icon.textContent = '-';
                    } else {
                        question.classList.add('q-closed');
                        answer.classList.remove('open');
                        icon.textContent = '+';
                    }
                });
            });
        }
        

    }, false);
});