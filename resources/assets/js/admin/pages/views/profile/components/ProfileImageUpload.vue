<template>
    <div class="profile-image-container" :class="{ 'uploading': uploading }">
        <input type="file" name="profile-image" @change="uploadProfileImage">
        <img class="img-responsive" :src="profile_image">
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            uploading: false,
        }
    },
    computed: {
		profile_image() {
            return this.$store.state.user.profile_image;
		}
    },
    methods: {
        uploadProfileImage(event) {
            this.uploading = true;

            let image = event.target.files[0];
            let reader = new FileReader();

            reader.readAsDataURL(image);

            reader.onload = (progress_event) => {
                axios.post(route('admin.api.auth.user.upload_profile_image'), { 'profile_image': progress_event.target.result })
                    .then((response) => {
                        this.$store.commit('SET_USER', response.data);

                        this.$awn.success('Profile image was uploaded successfully');

                        this.uploading = false;
                    })
                    .then(() => {
                        this.uploading = false;
                    });
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.profile-image-container {
    width: 100px;
    height: 100px;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
    border-radius: 50%;
    border: 4px solid #777;

    input {
        cursor: pointer;
        position: absolute;
        z-index: 2;
        width: 100%;
        height: 100%;
        opacity: 0;
    }

    img {
        z-index: 0;
        border-radius: 50%;
        border: 3px solid #fff;
    }

    &::after {
        font-family: FontAwesome;
        line-height: 90px;
        font-size: 3.2rem;
        content: '\f03e';
        color: #fff;
        text-align: center;
        display: block;
        position: absolute;
        z-index: 1;
        top: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 3px solid #fff;
        background-color: rgba(0,0,0, 0.4);
        opacity: 0;
    }

    &:not(.uploading):hover::after {
        opacity: 1;
    }

    &.uploading::after {
        content: '\f021';
        opacity: 1;
        animation: fa-spin 2s infinite linear;
    }

    @keyframes fa-spin {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(359deg);
            transform: rotate(359deg);
        }
    }
}
</style>
