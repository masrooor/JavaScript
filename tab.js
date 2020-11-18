

	window.addEventListener("load", function() {

	// store tabs variables
		var tabs = document.querySelectorAll("ul.new-tabs > li");

			for (i = 0; i < tabs.length; i++) {
				tabs[i].addEventListener("click", switchTab);
	}

	function switchTab(event) {
		event.preventDefault();

		document.querySelector("ul.new-tabs li.active").classList.remove("active");
		document.querySelector(".tab-pane.active").classList.remove("active");

		var clickedTab = event.currentTarget;
		var anchor = event.target;
		var activePaneID = anchor.getAttribute("href");

		clickedTab.classList.add("active");
		document.querySelector(activePaneID).classList.add("active");

	}

});
    <div class = "wrap">
        <ul class = "new-tabs">
          <li  class = "active"><a href="#tab-1"> Submissions </a></li>
          <li ><a href="#tab-2"> My Jobs </a></li> 
        </ul> 
        <br/><br/>
        <div class="tab-content">
          <div id="tab-1" class = "tab-pane active"></div>
          <div id="tab-2" class = "tab-pane"></div>
        </div>
    </div>
