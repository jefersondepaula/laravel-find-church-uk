@push('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

<div class="swiper mySwiper h-[550px]">
    <div class="swiper-wrapper">
        <div class="swiper-slide bg-cover bg-center bg-no-repeat" style="background-image: url('/assets/img/ground.png')">

        </div>
        <div class="swiper-slide bg-cover bg-center bg-no-repeat" style="background-image: url('/assets/img/birds-eye.png')">

        </div>
        <div class="swiper-slide bg-cover bg-center bg-no-repeat" style="background-image: url('/assets/img/capturing_the_heart.png')">

        </div>
        <div class="swiper-slide bg-cover bg-center bg-no-repeat" style="background-image: url('/assets/img/people.png')">

        </div>
        <div class="swiper-slide bg-cover bg-center bg-no-repeat" style="background-image: url('/assets/img/worship.png')">

        </div>
        <div class="swiper-slide bg-cover bg-center bg-no-repeat" style="background-image: url('/assets/img/pastor.png')">

        </div>
    </div>

    @include('components.forms.filters')

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
    <div class="autoplay-progress">
        <svg viewBox="0 0 48 48">
          <circle cx="24" cy="24" r="20"></circle>
        </svg>
        <span></span>
    </div>
  </div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const progressCircle = document.querySelector(".autoplay-progress svg");
        const progressContent = document.querySelector(".autoplay-progress span");
        var swiper = new Swiper(".mySwiper", {
          spaceBetween: 30,
          effect: "fade",
          autoplay: {
            delay: 4000,
            disableOnInteraction: false
        },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          on: {
            autoplayTimeLeft(s, time, progress) {
            progressCircle.style.setProperty("--progress", 1 - progress);
            progressContent.textContent = `${Math.ceil(time / 1000)}s`;
            }
        }
        });
      </script>
@endpush

<style>
    /* .swiper-slide {
      background-position: center;
      background-size: cover;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
    } */
    .autoplay-progress {
      position: absolute;
      right: 16px;
      bottom: 16px;
      z-index: 10;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: var(--swiper-theme-color);
    }

    .autoplay-progress svg {
      --progress: 0;
      position: absolute;
      left: 0;
      top: 0px;
      z-index: 10;
      width: 100%;
      height: 100%;
      stroke-width: 4px;
      stroke: var(--swiper-theme-color);
      fill: none;
      stroke-dashoffset: calc(125.6 * (1 - var(--progress)));
      stroke-dasharray: 125.6;
      transform: rotate(-90deg);
    }
</style>


