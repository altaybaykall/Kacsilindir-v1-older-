import DOMPurify from "dompurify"

export default class Search {
    // 1. Select DOM elements, and keep track of any useful data
    constructor() {
        this.injectHTML()
        this.headerSearchIcon = document.querySelector(".header-search-icon")
        this.overlay = document.querySelector(".search-overlay")
        this.closeIcon = document.querySelector(".close-live-search")
        this.inputField = document.querySelector("#live-search-field")
        this.resultsArea = document.querySelector(".live-search-results")
        this.loaderIcon = document.querySelector(".circle-loader")
        this.typingWaitTimer
        this.previousValue = ""
        this.events()
    }

    // 2. Events
    events() {
        this.inputField.addEventListener("keyup", () => this.keyPressHandler())
        this.closeIcon.addEventListener("click", () => this.closeOverlay())
        this.headerSearchIcon.addEventListener("click", e => {
            e.preventDefault()
            this.openOverlay()
        })
        document.addEventListener("keydown", e => {
            if (e.key.toUpperCase() == "S" && !this.overlay.classList.contains("search-overlay--visible") && document.activeElement.nodeName != "INPUT" && document.activeElement.nodeName != "TEXTAREA") {
                this.openOverlay()
            }

            if (e.key == "Escape" && this.overlay.classList.contains("search-overlay--visible")) {
                this.closeOverlay()
            }
        })
    }

    // 3. Methods
    keyPressHandler() {
        let value = this.inputField.value

        if (value == "") {
            clearTimeout(this.typingWaitTimer)
            this.hideLoaderIcon()
            this.hideResultsArea()
        }

        if (value != "" && value != this.previousValue) {
            clearTimeout(this.typingWaitTimer)
            this.showLoaderIcon()
            this.hideResultsArea()
            this.typingWaitTimer = setTimeout(() => this.sendRequest(), 750)
        }

        this.previousValue = value
    }

    async sendRequest() {
        const results = await axios(`/search/${this.inputField.value}`)
        this.renderResultsHTML(results.data)
    }

    renderResultsHTML(news) {
        if (news.length) {
            this.resultsArea.innerHTML = DOMPurify.sanitize(`<div class="list-group shadow-sm">
      <div class="list-group-item"><strong>Arama Sonuçları</strong> (${news.length > 1 ? `${news.length} Kayıt Bulundu` : "1 kayıt bulundu"})</div>
      ${news
                .map(news => {
                    let newsDate = new Date(news.created_at)
                    return `<a href="/haber/${news.id}" class="list-group-item list-group-item-action">
<img class="search-image" src="${news.image}"> <strong>${news.title}</strong>
        <span class="text-muted small">${news.getauthor.user_name} ${newsDate.getMonth() + 1}/${newsDate.getDate()}/${newsDate.getFullYear()}</span>

      </a>`
                })
                .join("")}
    </div>`)
        } else {
            this.resultsArea.innerHTML = `<p class="alert alert-danger text-center shadow-sm">Arama sonucu bulunmadı.</p>`
        }
        this.hideLoaderIcon()
        this.showResultsArea()
    }

    showLoaderIcon() {
        this.loaderIcon.classList.add("circle-loader--visible")
    }

    hideLoaderIcon() {
        this.loaderIcon.classList.remove("circle-loader--visible")
    }

    showResultsArea() {
        this.resultsArea.classList.add("live-search-results--visible")
    }

    hideResultsArea() {
        this.resultsArea.classList.remove("live-search-results--visible")
    }

    openOverlay() {
        this.overlay.classList.add("search-overlay--visible")
        setTimeout(() => this.inputField.focus(), 50)
    }

    closeOverlay() {
        this.overlay.classList.remove("search-overlay--visible")
    }

    injectHTML() {
        document.body.insertAdjacentHTML(
            "beforeend",
            `<div class="search-overlay">
    <div class="search-overlay-top shadow-sm">
      <div class="container container--narrow">
        <div class="search-overlay-icon">
        <svg fill="#ffffff" viewBox="-1 -1 17 17" width="23px" height="23px"  xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z" fill-rule="evenodd"></path> </g></svg>
        </div>
        <input autocomplete="off" type="text" id="live-search-field" class="live-search-field" placeholder="...">
        <span class="close-live-search"><i class="fas fa-times-circle"></i></span>
      </div>
    </div>

    <div class="search-overlay-bottom">
      <div class="container container--narrow py-3">
        <div class="circle-loader"></div>
        <div class="live-search-results"></div>
      </div>
    </div>
  </div>`
        )
    }
}
