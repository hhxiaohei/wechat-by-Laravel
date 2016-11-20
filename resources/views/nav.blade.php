<!-- 页脚 -->
<style>
    ::-webkit-scrollbar{
        display:none;
    }
    .weui_tabbar{
        position:fixed;
        bottom:0px;
    }
</style>
<div class="weui_tabbar">
  <a href="/center" class="weui_tabbar_item weui_bar_item_on">
    <div class="weui_tabbar_icon">
      <img src="/Home/images/icon_nav_button.png">
    </div>
    <p class="weui_tabbar_label">首页</p>
  </a>
  <a href="/cat" class="weui_tabbar_item">
    <div class="weui_tabbar_icon">
      <img src="/Home/images/icon_nav_article.png">
    </div>
    <p class="weui_tabbar_label">购物车</p>
  </a>
  <a href="/myMoney" class="weui_tabbar_item">
    <div class="weui_tabbar_icon">
      <img src="/Home/images/icon_nav_cell.png">
    </div>
    <p class="weui_tabbar_label">个人收益</p>
  </a>
  <a href="/logout" class="weui_tabbar_item" click="cli();">
    <div class="weui_tabbar_icon">
      <img src="/Home/images/icon_nav_noti.png">
    </div>
    <p class="weui_tabbar_label">退出</p>
  </a>
</div>