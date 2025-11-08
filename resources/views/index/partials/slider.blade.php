@php
    $slider = App\Models\Slider::findOrFail(1);
@endphp
<div class="lonyo-hero-section light-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 d-flex align-items-center">
                <div class="lonyo-hero-content" data-aos="fade-up" data-aos-duration="700">
                    <h1 id="slider_title" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $slider->id }}" class="hero-title">
                        {{ $slider->title }}
                    </h1>
                    <p id="slider_description" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $slider->id }}" class="text">{{ $slider->description }}</p>


                    <div class="mt-50" data-aos="fade-up" data-aos-duration="900">
                        <a href="{{ $slider->link }}" class="lonyo-default-btn hero-btn">Contact Us!</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="lonyo-hero-thumb" data-aos="fade-left" data-aos-duration="700">
                    <img src="{{ asset('backend/assets/upload/' . $slider->photo) }}"
                        style="width: 306px; height: 618px;" alt="">
                    <div class="lonyo-hero-shape">
                        <img src="{{ asset('frontend/assets/images/shape/hero-shape1.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSRF TOKEN -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const titleElement = document.getElementById('slider_title')
        const descElement = document.getElementById('slider_description')

        function saveChanges(element) {
            let sliderId = element.dataset.id;
            let field = element.id === "slider_title" ? "title" : "description";
            let newValue = element.innerText.trim();

            fetch(`/edit/slider/${sliderId}`, {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ [field]: newValue })
            })
                .then(response => {
                    if (!response.ok) throw new Error("Network response was not ok");
                    return response.json();
                })

                .then(data => {
                    if (data.success) {
                        console.log(`${field} updated succesfully`)
                    }
                })
                .catch(error => { console.error("Error:", error) })
        }
        // end method

        //auto save
        document.addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                saveChanges(e.target);
            }
        })
        //end event

        //save if lost focus
        titleElement.addEventListener("blur", function () {
            saveChanges(titleElement);
        })
        //end event
        descElement.addEventListener("blur", function () {
            saveChanges(descElement);
        })
        //end event

    })//end event
</script>