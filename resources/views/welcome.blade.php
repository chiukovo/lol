<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>troll or god</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="/css/style.css" rel="stylesheet" type="text/css">
        <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="/js/jquery.min.js"></script>
        <script src="/js/TweenMax.min.js"></script>
    </head>
    <body>
        <div class="container search-mode">
            <div id="search">
                <h1 class="title">
                    <div class="text">
                        <p>Teammate Are</p>
                        <p>
                            <span class="word wisteria">God</span>
                            <span class="word green">troll</span>
                            <span class="word midnight">shxt</span>
                        </p>
                    </div>
                </h1>
                <form id="search-form" action="/result">
                    <input id="search-box" type="text" name="target" required>
                    <label id="search-box-label" alt="Search" placeholder="Search" data-info="Search"></label>
                    <button type="submit" name="submit" id="submit" class="button">
                    <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </body>
    <script>
        var words = document.getElementsByClassName('word');
        var wordArray = [];
        var currentWord = 0;

        words[currentWord].style.opacity = 1;
        for (var i = 0; i < words.length; i++) {
          splitLetters(words[i]);
        }

        function changeWord() {
          var cw = wordArray[currentWord];
          var nw = currentWord == words.length-1 ? wordArray[0] : wordArray[currentWord+1];
          for (var i = 0; i < cw.length; i++) {
            animateLetterOut(cw, i);
          }

          for (var i = 0; i < nw.length; i++) {
            nw[i].className = 'letter behind';
            nw[0].parentElement.style.opacity = 1;
            animateLetterIn(nw, i);
          }

          currentWord = (currentWord == wordArray.length-1) ? 0 : currentWord+1;
        }

        function animateLetterOut(cw, i) {
          setTimeout(function() {
                cw[i].className = 'letter out';
          }, i*80);
        }

        function animateLetterIn(nw, i) {
          setTimeout(function() {
                nw[i].className = 'letter in';
          }, 340+(i*80));
        }

        function splitLetters(word) {
          var content = word.innerHTML;
          word.innerHTML = '';
          var letters = [];
          for (var i = 0; i < content.length; i++) {
            var letter = document.createElement('span');
            letter.className = 'letter';
            letter.innerHTML = content.charAt(i);
            word.appendChild(letter);
            letters.push(letter);
          }

          wordArray.push(letters);
        }

        changeWord();
        setInterval(changeWord, 2000);
    </script>
</html>