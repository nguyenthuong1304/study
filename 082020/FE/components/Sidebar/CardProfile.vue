<template>
  <div class="col-md-2 col-lg-2 col-xl-12">
    <div class="card left-profile-card">
      <div class="card-body">
        <div class="text-center">
          <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt class="user-profile" />
          <h3>{{ user.full_name }}</h3>
          <p>World of Internet</p>
          <div class="d-flex align-items-center justify-content-center mb-3">
            <i class="fas fa-star text-info"></i>
            <i class="fas fa-star text-info"></i>
            <i class="fas fa-star text-info"></i>
            <i class="fas fa-star text-info"></i>
            <i class="fas fa-star text-info"></i>
          </div>
        </div>
        <div class="personal-info">
          <h3>Personal Information</h3>
          <ul class="personal-list">
            <li>
              <i class="fas fa-briefcase"></i>
              <span>Web Designer</span>
            </li>
            <li>
              <i class="fas fa-map-marker-alt"></i>
              <span>New York</span>
            </li>
            <li>
              <i class="far fa-envelope"></i>
              <span>like @example.com</span>
            </li>
            <li>
              <i class="fas fa-mobile"></i>
              <span>1234564343</span>
            </li>
          </ul>
        </div>
        <div class="skill">
          <h3>Skills</h3>
          <p>Adobe Photoshop</p>
          <div class="progress mb-3">
            <div
              class="progress-bar"
              role="progressbar"
              style="width: 75%"
              aria-valuenow="50"
              aria-valuemin="0"
              aria-valuemax="100"
            ></div>
          </div>
          <p>HTML5 &amp; CSS3</p>
          <div class="progress mb-3">
            <div
              class="progress-bar"
              role="progressbar"
              style="width: 85%"
              aria-valuenow="50"
              aria-valuemin="0"
              aria-valuemax="100"
            ></div>
          </div>
          <p>Javascript &amp; Jquery</p>
          <div class="progress mb-3">
            <div
              class="progress-bar"
              role="progressbar"
              style="width: 60%"
              aria-valuenow="50"
              aria-valuemin="0"
              aria-valuemax="100"
            ></div>
          </div>
          <p>Angular &amp; React</p>
          <div class="progress mb-3">
            <div
              class="progress-bar"
              role="progressbar"
              style="width: 50%"
              aria-valuenow="50"
              aria-valuemin="0"
              aria-valuemax="100"
            ></div>
          </div>
        </div>
        <div class="languages">
          <h3>Languages</h3>
          <p>English</p>
          <div class="progress mb-3">
            <div
              class="progress-bar"
              role="progressbar"
              style="width: 90%"
              aria-valuenow="50"
              aria-valuemin="0"
              aria-valuemax="100"
            ></div>
          </div>
          <p>German</p>
          <div class="progress mb-3">
            <div
              class="progress-bar"
              role="progressbar"
              style="width: 75%"
              aria-valuenow="50"
              aria-valuemin="0"
              aria-valuemax="100"
            ></div>
          </div>
          <p>Hindi</p>
          <div class="progress mb-3">
            <div
              class="progress-bar"
              role="progressbar"
              style="width: 50%"
              aria-valuenow="50"
              aria-valuemin="0"
              aria-valuemax="100"
            ></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    props: {
        user: Object
    },
    name: 'CardProfile',
};
</script>

<style>
</style>