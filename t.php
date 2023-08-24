<button onclick='triggerTag(this,"TOUT");' id='filtre' class="active">TOUT</button>
<button onclick='triggerTag(this,"TYPE");' id='filtre'>TYPE</button>
<button onclick='triggerTag(this,"ETAT");' id='filtre'>ETAT</button>
<div class="result"></div>
<script>
    var start = 0;
    var limit = 12;
    var sort = 'ASC';
    var lastTag = document.querySelector('.active');
    var lastName = "TOUT";
    var arrowList = ['▲', '▼'];
    var sortList = ['ASC','DESC'];
    var is_asc = true;
    var it = 0;

    var liste = new Array(29).fill(0).map((e,i)=>i+1);


    function triggerTag(el, name) {
        var tags = document.querySelectorAll('#filtre'); // Ajoutez la classe "tag" à vos boutons de filtre

        tags.forEach(function (tag) {
            tag.classList.remove('active');
            tag.innerHTML = tag.innerHTML.replace(' ▲', '').replace(' ▼', '');
        });

        el.classList.add('active');
        if (!el.innerHTML.includes('TOUT')) {

            it = (it + 1) % 2;
            
            if (sortList[it] === 'ASC') {
                el.innerHTML = name + ' ▲';
            } else {
                el.innerHTML = name + ' ▼';
            }
        }

        research(start = 0, limit, name, sortList[it], true);
    }

    function nextBTN() {
        start += limit;
        research(start, limit, document.querySelector('.active').innerHTML, sort);
    }

    function research(start, limit, tag, sort,reset = false) {
        if (reset) {
            document.querySelector('.result').innerHTML = '';
        }
        document.querySelectorAll('.next').forEach(function(el) {
            el.remove();
        });
        document.querySelector('.result').innerHTML += '<p id="res">start: ' + start + ', limit: ' + limit + ', tag: ' + tag + ', sort: ' + sort+"<br>"+liste.slice(start, start+limit)+"</p>";
        if (start + limit <= liste.length) {
            document.querySelector('body').innerHTML += '<div class="next"><button href="#filtre" onclick="nextBTN();">V</button></div>';
        }
    }

    window.onload = function() {
        research(start, limit, lastTag.innerHTML, sort);
    }
</script>
<style>
    button {
        padding: 10px;
        border: none;
        background: #eee;
    }
    button.active {
        background: #ccc;
    }
</style>