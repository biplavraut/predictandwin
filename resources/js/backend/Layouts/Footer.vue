<template>
    <footer class="footer">
        <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2021 - {{year}} <a href="#" target="_blank">Predict and Win</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i>
            </span>
        </div>
    </footer>
</template>
<script>
export default {
    data() {
    return {
      year: new Date().getFullYear()
    };
  }
}
</script>