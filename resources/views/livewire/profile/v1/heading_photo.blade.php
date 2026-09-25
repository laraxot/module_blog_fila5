<div class="lg:w-1/3 pr-4 pl-4">
    <div class="boardprofile bio wow fadeInDown">
      <div class="boardprofile__thumb mb20 text-center">

        @php
<<<<<<< HEAD
<<<<<<< HEAD
            if($this->profile->avatar === ''){
              $url = $_theme->asset('pub_theme::assets/images/bio_profile.png');
            }else{
              $url = $this->profile->avatar;
=======
=======
>>>>>>> b591d4e (Lint)
            if($this->model->avatar = ''){
              $url = $_theme->asset('pub_theme::assets/images/bio_profile.png');
            }else{
              $url = $this->model->avatar;
<<<<<<< HEAD
>>>>>>> laraxot/dev
=======
>>>>>>> b591d4e (Lint)
            }
        @endphp


        <img src="
<<<<<<< HEAD
<<<<<<< HEAD
          {{-- {{ $this->profile->getFirstMediaUrl('photo_profile') }} --}}
=======
          {{-- {{ $this->model->getFirstMediaUrl('photo_profile') }} --}}
>>>>>>> laraxot/dev
=======
          {{-- {{ $this->model->getFirstMediaUrl('photo_profile') }} --}}
>>>>>>> b591d4e (Lint)
          {{-- {{ $_theme->asset('pub_theme::assets/images/bio_profile.png') }} --}}
          {{ $url }}
          " alt="Image"
          {{-- style="wight:180px;height:180px;aspect-ratio: 1/1;" --}}
          >
      </div>
      <div class="boardprofile__profile-text bio__dotted text-center">
<<<<<<< HEAD
<<<<<<< HEAD
        <span class="bio__name mb10 block">{{ $this->profile->full_name }}</span>
=======
        <span class="bio__name mb10 block">{{ $this->model->full_name }}</span>
>>>>>>> laraxot/dev
=======
        <span class="bio__name mb10 block">{{ $this->model->full_name }}</span>
>>>>>>> b591d4e (Lint)
        {{-- <div class="parent justify-center">
          <span class="tlt"></span>
          <span class="left">2xS7C70e458024e8F8DA......</span>
          <div class="right">
            <i class="material-symbols-outlined"> content_copy </i>
          </div>
        </div> --}}
        {{-- <p class="f14 mb-2 lg:mb-4">
          Nam congue gravida justo. Morbi sed rhoncus ipsum, nec ven.
        </p> --}}
      </div>
      <div class="bio__info mt20 pb-2 lg:pb-4 bio__dotted">
        <span class="mb10">BIO</span>
        <p class="f14">
          Nam congue gravida justo. Morbi sed rhoncus ipsum, nec ven.
        </p>
      </div>
      <div class="bio__location bio__dotted mt20 pb-2 lg:pb-4">
<<<<<<< HEAD
<<<<<<< HEAD
        <span class="mb-1 sm:mb-2 block">{{ $this->profile->email }}</span>
        <span>LONDON, United Kingdom</span>
      </div>
      <div class="bio__member-date mt20">
        <span>Iscritto dal {{ $this->profile->created_at->format('d/m/y') }}</span>
=======
=======
>>>>>>> b591d4e (Lint)
        <span class="mb-1 sm:mb-2 block">{{ $this->model->email }}</span>
        <span>LONDON, United Kingdom</span>
      </div>
      <div class="bio__member-date mt20">
        <span>Iscritto dal {{ $this->model->created_at->format('d/m/y') }}</span>
<<<<<<< HEAD
>>>>>>> laraxot/dev
=======
>>>>>>> b591d4e (Lint)
      </div>
    </div>
</div>