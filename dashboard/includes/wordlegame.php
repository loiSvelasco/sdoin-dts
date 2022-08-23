<div class="content-wrapper wrapper-bgcolor">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Wordle</li>
          </ol>
        </div>
      </div>
    </div>
  </div>


  <div class="content">
    <div class="container-fluid">
      <?php display_notice();?>
      <div class="header">
      <div class="header-actions">
        <button id="howtoplay"></button>
      </div>
      <div class="title">
        <span>Wordle</span>
        <span>SDOIN - eDTS</span>
      </div>
      <div class="header-actions">
        <button id="stats"></button>
        <button id="settings"></button>
      </div>
    </div>
    <div class="words"></div>
    <span id="candidates-left" style="margin-top: 16px;"></span>
    <div style="position: relative; margin-top: 16px;">
      <div class="keyboard"></div>
      <div class="end-actions">
        <span id="word-answer"></span>
        <span>Answer</span>
        <button id="playagain" tabindex="-1" onclick="onClickPlayAgain()">Play<br>Again</button>
      </div>
    </div>
    <div class="modal">
      <button class="modal-close"></button>
      <div class="modal-title"></div>
      <div class="modal-content"></div>
    </div>
    <div class="overlay">
      <div class="howtoplay">
        <button class="howtoplay-close"></button>
        <b style="align-self: center; font-size: 17px;">HOW TO PLAY</b>
        <br>
        <span>Guess the <b>WORDLE</b> in 6 attempts.</span>
        <br>
        <span>Each guess must be a valid 5 letter word. Hit the Enter button to submit an attempt.</span>
        <br>
        <span>After each guess, the color of the tiles will change to show how close your guess was to the word.</span>
        <br>
        <div class="line-sep"></div>
        <br>
        <b>Examples</b>
        <div style="display: flex;" class="letters-example">
          <div style="background: #6AAA64; border-color: #6AAA64;">W</div>
          <div>E</div>
          <div>A</div>
          <div>R</div>
          <div>Y</div>
        </div>
        <span>The letter W is in the word and in the correct spot.</span>
        <div style="display: flex;" class="letters-example">
          <div>P</div>
          <div style="background: #C9B458; border-color: #C9B458;">I</div>
          <div>L</div>
          <div>L</div>
          <div>S</div>
        </div>
        <span>The letter I is in the word but in the wrong spot.</span>
        <div style="display: flex;" class="letters-example">
          <div>V</div>
          <div>A</div>
          <div>G</div>
          <div style="background: #787C7E; border-color: #787C7E;">U</div>
          <div>E</div>
        </div>
        <span>The letter U is not in the word in any spot.</span>
      </div>
      <div class="settings">
        <button class="settings-close"></button>
        <br>
        <b style="align-self: center; font-size: 17px;">SETTINGS</b>
      </div>
    </div>
    <div class="backdrop"></div>
    </div>
    <div class="row">
    </div>
  </div>
  <!-- <script src="dist/js/wordle.js"></script> -->

  <!-- <iframe src="/dashboard/includes/wordle.html" title="e-DTS Wordle" scrolling="no" 
          frameborder="0" 
          style="
              position: static; 
              height: 100vh; 
              width: 100%; 
          ">
  </iframe> -->
</div>
