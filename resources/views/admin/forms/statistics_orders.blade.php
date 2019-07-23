@extends('admin.main')

@section('form')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-cube"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Количество</span>
        <span class="info-box-number">{{ $orders_count }}</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение заказов по статусу</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="orders_chart_bar_statuses" width="300" height="125"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение заказов по способу доставки</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="orders_chart_bar_deliveries" width="300" height="125"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<hr>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon" style="background-color: #a95f8a;">
        <img src="data:image/png;base64,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" alt="Клумба">
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Количество заказов сортов секции "Клумба"</span>
        <span class="info-box-number">{{ $orders_count_sorts_sections['Клумба'] }}</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение заказов по культурам секции "Клумба"</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="orders_chart_bar_klumba" width="300" height="75"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<hr>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon" style="background-color: #f39a24;">
        <img src="data:image/png;base64,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" alt="Огород">
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Количество заказов сортов секции "Огород"</span>
        <span class="info-box-number">{{ $orders_count_sorts_sections['Огород'] }}</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение заказов по культурам секции "Огород"</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="orders_chart_bar_ogorod" width="300" height="75"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<hr>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon" style="background-color: #179e36;">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEUAAABKCAYAAADt25n8AAAACXBIWXMAAC4jAAAuIwF4pT92AAAKTWlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjanVN3WJP3Fj7f92UPVkLY8LGXbIEAIiOsCMgQWaIQkgBhhBASQMWFiApWFBURnEhVxILVCkidiOKgKLhnQYqIWotVXDjuH9yntX167+3t+9f7vOec5/zOec8PgBESJpHmomoAOVKFPDrYH49PSMTJvYACFUjgBCAQ5svCZwXFAADwA3l4fnSwP/wBr28AAgBw1S4kEsfh/4O6UCZXACCRAOAiEucLAZBSAMguVMgUAMgYALBTs2QKAJQAAGx5fEIiAKoNAOz0ST4FANipk9wXANiiHKkIAI0BAJkoRyQCQLsAYFWBUiwCwMIAoKxAIi4EwK4BgFm2MkcCgL0FAHaOWJAPQGAAgJlCLMwAIDgCAEMeE80DIEwDoDDSv+CpX3CFuEgBAMDLlc2XS9IzFLiV0Bp38vDg4iHiwmyxQmEXKRBmCeQinJebIxNI5wNMzgwAABr50cH+OD+Q5+bk4eZm52zv9MWi/mvwbyI+IfHf/ryMAgQAEE7P79pf5eXWA3DHAbB1v2upWwDaVgBo3/ldM9sJoFoK0Hr5i3k4/EAenqFQyDwdHAoLC+0lYqG9MOOLPv8z4W/gi372/EAe/tt68ABxmkCZrcCjg/1xYW52rlKO58sEQjFu9+cj/seFf/2OKdHiNLFcLBWK8ViJuFAiTcd5uVKRRCHJleIS6X8y8R+W/QmTdw0ArIZPwE62B7XLbMB+7gECiw5Y0nYAQH7zLYwaC5EAEGc0Mnn3AACTv/mPQCsBAM2XpOMAALzoGFyolBdMxggAAESggSqwQQcMwRSswA6cwR28wBcCYQZEQAwkwDwQQgbkgBwKoRiWQRlUwDrYBLWwAxqgEZrhELTBMTgN5+ASXIHrcBcGYBiewhi8hgkEQcgIE2EhOogRYo7YIs4IF5mOBCJhSDSSgKQg6YgUUSLFyHKkAqlCapFdSCPyLXIUOY1cQPqQ28ggMor8irxHMZSBslED1AJ1QLmoHxqKxqBz0XQ0D12AlqJr0Rq0Hj2AtqKn0UvodXQAfYqOY4DRMQ5mjNlhXIyHRWCJWBomxxZj5Vg1Vo81Yx1YN3YVG8CeYe8IJAKLgBPsCF6EEMJsgpCQR1hMWEOoJewjtBK6CFcJg4Qxwicik6hPtCV6EvnEeGI6sZBYRqwm7iEeIZ4lXicOE1+TSCQOyZLkTgohJZAySQtJa0jbSC2kU6Q+0hBpnEwm65Btyd7kCLKArCCXkbeQD5BPkvvJw+S3FDrFiOJMCaIkUqSUEko1ZT/lBKWfMkKZoKpRzame1AiqiDqfWkltoHZQL1OHqRM0dZolzZsWQ8ukLaPV0JppZ2n3aC/pdLoJ3YMeRZfQl9Jr6Afp5+mD9HcMDYYNg8dIYigZaxl7GacYtxkvmUymBdOXmchUMNcyG5lnmA+Yb1VYKvYqfBWRyhKVOpVWlX6V56pUVXNVP9V5qgtUq1UPq15WfaZGVbNQ46kJ1Bar1akdVbupNq7OUndSj1DPUV+jvl/9gvpjDbKGhUaghkijVGO3xhmNIRbGMmXxWELWclYD6yxrmE1iW7L57Ex2Bfsbdi97TFNDc6pmrGaRZp3mcc0BDsax4PA52ZxKziHODc57LQMtPy2x1mqtZq1+rTfaetq+2mLtcu0W7eva73VwnUCdLJ31Om0693UJuja6UbqFutt1z+o+02PreekJ9cr1Dund0Uf1bfSj9Rfq79bv0R83MDQINpAZbDE4Y/DMkGPoa5hpuNHwhOGoEctoupHEaKPRSaMnuCbuh2fjNXgXPmasbxxirDTeZdxrPGFiaTLbpMSkxeS+Kc2Ua5pmutG003TMzMgs3KzYrMnsjjnVnGueYb7ZvNv8jYWlRZzFSos2i8eW2pZ8ywWWTZb3rJhWPlZ5VvVW16xJ1lzrLOtt1ldsUBtXmwybOpvLtqitm63Edptt3xTiFI8p0in1U27aMez87ArsmuwG7Tn2YfYl9m32zx3MHBId1jt0O3xydHXMdmxwvOuk4TTDqcSpw+lXZxtnoXOd8zUXpkuQyxKXdpcXU22niqdun3rLleUa7rrStdP1o5u7m9yt2W3U3cw9xX2r+00umxvJXcM970H08PdY4nHM452nm6fC85DnL152Xlle+70eT7OcJp7WMG3I28Rb4L3Le2A6Pj1l+s7pAz7GPgKfep+Hvqa+It89viN+1n6Zfgf8nvs7+sv9j/i/4XnyFvFOBWABwQHlAb2BGoGzA2sDHwSZBKUHNQWNBbsGLww+FUIMCQ1ZH3KTb8AX8hv5YzPcZyya0RXKCJ0VWhv6MMwmTB7WEY6GzwjfEH5vpvlM6cy2CIjgR2yIuB9pGZkX+X0UKSoyqi7qUbRTdHF09yzWrORZ+2e9jvGPqYy5O9tqtnJ2Z6xqbFJsY+ybuIC4qriBeIf4RfGXEnQTJAntieTE2MQ9ieNzAudsmjOc5JpUlnRjruXcorkX5unOy553PFk1WZB8OIWYEpeyP+WDIEJQLxhP5aduTR0T8oSbhU9FvqKNolGxt7hKPJLmnVaV9jjdO31D+miGT0Z1xjMJT1IreZEZkrkj801WRNberM/ZcdktOZSclJyjUg1plrQr1zC3KLdPZisrkw3keeZtyhuTh8r35CP5c/PbFWyFTNGjtFKuUA4WTC+oK3hbGFt4uEi9SFrUM99m/ur5IwuCFny9kLBQuLCz2Lh4WfHgIr9FuxYji1MXdy4xXVK6ZHhp8NJ9y2jLspb9UOJYUlXyannc8o5Sg9KlpUMrglc0lamUycturvRauWMVYZVkVe9ql9VbVn8qF5VfrHCsqK74sEa45uJXTl/VfPV5bdra3kq3yu3rSOuk626s91m/r0q9akHV0IbwDa0b8Y3lG19tSt50oXpq9Y7NtM3KzQM1YTXtW8y2rNvyoTaj9nqdf13LVv2tq7e+2Sba1r/dd3vzDoMdFTve75TsvLUreFdrvUV99W7S7oLdjxpiG7q/5n7duEd3T8Wej3ulewf2Re/ranRvbNyvv7+yCW1SNo0eSDpw5ZuAb9qb7Zp3tXBaKg7CQeXBJ9+mfHvjUOihzsPcw83fmX+39QjrSHkr0jq/dawto22gPaG97+iMo50dXh1Hvrf/fu8x42N1xzWPV56gnSg98fnkgpPjp2Snnp1OPz3Umdx590z8mWtdUV29Z0PPnj8XdO5Mt1/3yfPe549d8Lxw9CL3Ytslt0utPa49R35w/eFIr1tv62X3y+1XPK509E3rO9Hv03/6asDVc9f41y5dn3m978bsG7duJt0cuCW69fh29u0XdwruTNxdeo94r/y+2v3qB/oP6n+0/rFlwG3g+GDAYM/DWQ/vDgmHnv6U/9OH4dJHzEfVI0YjjY+dHx8bDRq98mTOk+GnsqcTz8p+Vv9563Or59/94vtLz1j82PAL+YvPv655qfNy76uprzrHI8cfvM55PfGm/K3O233vuO+638e9H5ko/ED+UPPR+mPHp9BP9z7nfP78L/eE8/sl0p8zAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAwpSURBVHja7Jx3tFXVEcZ/7/FodmMDlSBEAoiooCKKBY3RGKUoidFYYo0tRbFriBpLNJZFYhRFY0VwiYkSBBURGyAkSDQo2ALEgthQQBRpX/5431lsdva597537yMvibPWWfec2bPLmTN79szs2bdKUhWlg6LnKuP6ATsAi4ChwBeJutWJ+o0JVo9NUlUJF75OkPQPSU9K+ppx/bUmTDW+o6QxkqZJOjFqJ7yqGuiihCtJW1WipAjYEPg0wD0MHAFMAPaI6HsABwOXBLimwArgJKAVMBaYbmlruK8OTYCVwfP6vublVa4u0Ggs6l8C7wbPbYCNgeaJ+p2i+p+YIVcDtwGXAy8AR1d4SmXj3g4YAowHpgJvAM8B1wNzfX9OfivFxS7Eby3pTkk/D8qHBlNnlaTXJbWW1FfSOEnPS+pq2lXRVJtdwWmUtXOOpMmSbpN0qKSdJfWT9Jj7vETSupJmSvpRalrF00fAjsB1QDPgQmByoFBDOMa4VsAqS8fJwFXAxQn+9wImRrgPgC0ixV2OlJwLDAAOAT5K0AwHtgGuAdoC3YDjY6KaqNF1PfD1jJsEtAfmAN/1y9YA/wR2Am4GFgLvAzcAs4CPXfcHwD7A6X4e4Hm8ZdDnWYkXq6onQ9r4A/UM8Gda77UBlgADgX2BTU37eLHpg6RN9O+wrcUthrcktXO9tyXtEonhkaY7Pmh7PUkXSBopqafx7SS96FWqQz2nEpIOkbRb0P/vJd0nqbukTpJGeTxI2kbSuXmrUmpZeix6+W9IOlxpGOc6YyS94PsaD2CJpEWSPpJ0RaLzbczsK4L2rqkHU7L2+khq5fvTJD0haT9Jl0v6lvHzfW1XaKmuSRhihwPnAW97mmT6IgWb+PeqQF8cC/SN6C720nihnw8EbvUUnO6VaR5wRT2nUROPZT7QBRgM3OEp0tyr0A3AMuA4YHP3MauU6ZN3bZ8jKaEIfukVZ2gO7Sem6yvpZUvQREkHSWrpsmslDanjioSkDb3qbCBpiqR7fJ+1c3QwDiRdKenpYtMnVdhE0qVuoLuk8/xikrRc0h0R/UueeoNzmDJKUu8E/gvXPz/A3VMiY8L+T5F0uqSTc97nALc9y7/HFmPKBpJ+4bV9WxdOigZ/vaSNJJ0p6eJEY5dLeq+A/ukp6aacsnkJ3F0lMAbbRK398ToVkfi9JD0j6dRCdNnNycFgulnEU/BjSb/0S1wQNXaQabaTNEjS50G9K01zo+oGfyjAGDzW5ZI+k7RY0lh/sJoSfZ+CTOkuaaGkOV42J+YM8hE7hJJ0sKR9AnHN9M7P/NxK0nGSdgw67KC6wy05jEHSGTl1ymZK1kHLoODWnM528vTqY7vkY+N7SVrf97dFnZwX2TB7SnqljowZHDEmu789QTu5HIakFO3ekgZIOiwxz+d73UdS06hshW0BSRoftLeRpFcDGya7HqqHxFyX8MnmJuh+XS5TwsDPLcAzwIP2f7oD44AxDgG8b/8ls0ViO6G77Y2NjesHzAY2Azo7VNDLfkf/AjbHYOBU20chnG0vO4PO9l9iGF2+r13LnfYRt6cEnMuk4yRJO/i+eeTxfmrdsdJBpk0lLVX9IPPAp+WUX+XyXRNlK2wllyUpmUU7G5gSOFNT/LsrMMpfN7M2+wMLgK7AIEvGucArjs+sBI7MibOk4AFgK0vRI8ByO5mr7LAdGNFf6LZbJdoab8evIpKCYx5nOOSIpH2jOMlA4/e3grvTy3BWfzvTTrMdUAqEBlRn//4qKG/mmEipcFa5UpIp2la28t5wvLWQMtw0KO/tOpOC1UuS3rdH/GKBwS+wtZwaVHt7t+cHuKNKZMoelWBKjZ2yzOEb6NgriRjmh8Dnvv8msDvQAXjT4b6nXbahYypHAzMKxD9muo197aj1s8I+BDgqor/PNA8UEPoVwIuVCWrWfuGbJD1odz7j2JaBsltqWySjv9z4040Lrdc5gdOVgmeDaddU0uio/HX7XSlntW8BKXm8ElISWrSFrh292mTPMxKrwU+C5w8LTJ1BifZfT9D1KDCe3W3Wx/BkJZkSfolzbcpPsRXa0i99q93vnXJe9nyHAwrBoUE/1cH93Qna9kUG3jHw2EMYUmmmxG5974TlmmeeHyZpRE7ZO8HGWXy1sBQO9bSbGKxCxa7WQRgghOGVslMIgtUZLLPNEEbBpntTq0NANw34k/dyYljk/ZddHEXv6n2YYcAIYD/vw7zhDaoaoA/wO+8mZLAEeMh7Rhm8ZztqkrdsMzgSWAqcUI6izZRZU++JTHB4IOPccEl/lXRvoGPGSHrT0oHpU9DNDmQMJya+8hArYUma7j6ya5Z1VerLNsvx6u8qd/pU5YQgZzpwdHui/Hi79Q/mMORq07VJlD0l6VGvaovNvMyAW5zo6+uBPZS3J5yyq24tlykhY9YxMxQttYNy9E8MnwYxjc6J8hmShkk6wvFVgm2KDyJFjLcuni7hhUZXwmuuTqRWAHw74Vu0CiL2TwN/LzArL7AxhSPm/YB3/PyyI/k9gMuAG4GWwX71qoSHvKxEbTA2gTukriqlJgf/ZgI3GXgqCBXMiBRcBm8Bjzrc8JqVbXtgpOuPthN5Y2AdP2xlvQRYJ9HmUvdZDHokcI+Wo2jjaRTGbV+137OntyH+Jukihx5jGC9pKxtTipzKXoGYzo/K3w1sjwV+zq4FVvbFRP+txHgGlLMkx9PoNuB5+zKTHHh6LqCZ5w2nJd6DzqCnUzZGeskN27zf+7otLUHXBJvs6zuFoo+n19KgbgegY5Hv28Ftx/CXSklKajW6N/EVLvOSnYrl3pmjhDNFPj3RRyeHQWP85t6aKPSFT8pR6JSraGNpqQqU78QEzUhLUyrtYngC/5p/W1iftYvKt7HuaBHh25aQ3POdBG5cfWy36jrQ3h4x4E6vJM0StN8DngB+E0XF+udYz8WglH3lXXMWByq1+qQGtdK5bfv4a04I5nIMvYGtgfMdC1kvGuCqCue47QJ8PcJ9Xl9Jqanj15Ij/iG0z6HfH7iriD1TKeidwL0ALG5opsRinM3xzXNoty8zma8YLoSUvfRSfTlcXeYXqgr2eWLYq8jHWOG0sdhorLJlG8LcIsZbzwRuar1fqo4Z16k8szk5A5bz2+YnyjZwzHes00kz2NbMvM+MyabstrZhNsuxT15P4NsErkWDTp8Y1i3wBasclB6RE2cZbr+kaRQ3mQIcasW+0u0sB+6uw1I8s74MqQRTWhQp75bDFFKpmvWEnRK4aeU0WF3G1AHYqB4GVSWhqd2CGB5a20ypS9p415ztzUrBDgk9o8CGWitMqU8efc8GZEr3BG6GddZaYUqKIaVYpt0akCl7JHBPldtodZkSsrCEug2lV5oAB5QYfasoU4pZkqWIaY8c/6hc2Is18/zLcgIruSTPK1C2kNrYajMba5WG5tTmyYQHnKYDn5XbcJ5FWxeFeia1qd3LfL1jp3GYrdIaVmcrVBpaRExZXolGU0xpzIcf1wpUR97v/z1DQqboK4akmfIVBEz5iiEVXpILQRdWR99mUxsJW/ZfwZVKpUQF10+9o5hK3rmoAfqr+FUlVWz2bExtcvAeReimkn9EtlEp2krAsyUwRMBu1GYb8L/OlIGko/cTqE3DuDSyh3bJaadtA7kE/xGd8kagOz7zwYV4H3dxgT3e3STdH2QcnJbTz34+q3htQ+qUSjSyWaRQX/VpilMCmnYRzZigrEuBfLm4rywnbkJDMqUS0yfew+3oWMfkyKMNYZJ/m5IfpT8ugesQOIKNWqe0TuC+ZM1sqNeAH1K7ffEwcJPx6wA7+/7PrHn4adOozb1ZHe/t0th1SioLe6XxpdTv4Dz+tsGhb0m6OaK7NOrjwMY8fV5i9T9hhBJ4cYGYbRiBb0/t5tdc2y5NAukKoX/0/NvGvvqMylGWAxMHurNDmu19jDdMSQ3h+9GZAfmvAEZakcspogc1xtUnWyrzYJKZNj1ICJT/AWeI7//odsYnjt2ODXCLEifr5ZPpjY4p2K8pFYZGEvCpl+kFUVZ22xLbO6qxMgVJF5bwAuHxk5YFToaM8BGW8Ijd2c727mzGLjTdFo3VIcxgN+AM2y/Z/y19SG1G0zBqT6/GwefrrWCfYPV/txxjO+ZJ7xoMYs2sqOauu7DSL/CvAQByo2r66HBGMAAAAABJRU5ErkJggg==" alt="Сад">
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Количество заказов сортов секции "Сад"</span>
        <span class="info-box-number">{{ $orders_count_sorts_sections['Сад'] }}</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение заказов по культурам секции "Сад"</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="orders_chart_bar_sad" width="300" height="75"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<hr>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="ion ion-erlenmeyer-flask"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Количество заказов химикатов</span>
        <span class="info-box-number">{{ $orders_count_chemicals }}</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение заказов по типам химикатов</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="orders_chart_bar_chemical_type" width="300" height="125"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение заказов по производителям химикатов</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="orders_chart_bar_chemical_manufacturer" width="300" height="125"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
@parent
<script src="{{ asset('adminlte/asset/Chart.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  /* Order statistics */
  var orders_chart_bar_statuses_ctx = document.getElementById("orders_chart_bar_statuses");
  var orders_chart_bar_deliveries_ctx = document.getElementById("orders_chart_bar_deliveries");
  var orders_chart_bar_statuses_chart;
  var orders_chart_bar_deliveries_chart;

  orders_chart_bar_statuses_chart = new Chart(orders_chart_bar_statuses_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($orders_count_statuses as $count){{ $count }},@endforeach],
        backgroundColor: '#f39c12'
      }],
      labels: [@foreach($orders_count_statuses as $status => $count)'{{ $status }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  orders_chart_bar_deliveries_chart = new Chart(orders_chart_bar_deliveries_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($orders_count_deliveries as $count){{ $count }},@endforeach],
        backgroundColor: '#f39c12'
      }],
      labels: [@foreach($orders_count_deliveries as $delivery => $count)'{{ $delivery }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  /* End order statistics */

  /* Klumba statistics */
  var orders_chart_bar_klumba_ctx = document.getElementById("orders_chart_bar_klumba");
  var orders_chart_bar_klumba_chart;

  orders_chart_bar_klumba_chart = new Chart(orders_chart_bar_klumba_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($orders_count_sorts_cultures['Клумба'] as $count){{ $count }},@endforeach],
        backgroundColor: '#a95f8a'
      }],
      labels: [@foreach($orders_count_sorts_cultures['Клумба'] as $culture => $count)'{{ $culture }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  /* End klumba statistics */

  /* Ogorod statistics */
  var orders_chart_bar_ogorod_ctx = document.getElementById("orders_chart_bar_ogorod");
  var orders_chart_bar_ogorod_chart;

  orders_chart_bar_ogorod_chart = new Chart(orders_chart_bar_ogorod_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($orders_count_sorts_cultures['Огород'] as $count){{ $count }},@endforeach],
        backgroundColor: '#f39a24'
      }],
      labels: [@foreach($orders_count_sorts_cultures['Огород'] as $culture => $count)'{{ $culture }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  /* End ogorod statistics */

  /* Sad statistics */
  var orders_chart_bar_sad_ctx = document.getElementById("orders_chart_bar_sad");
  var orders_chart_bar_sad_chart;

  orders_chart_bar_sad_chart = new Chart(orders_chart_bar_sad_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($orders_count_sorts_cultures['Сад'] as $count){{ $count }},@endforeach],
        backgroundColor: '#179e36'
      }],
      labels: [@foreach($orders_count_sorts_cultures['Сад'] as $culture => $count)'{{ $culture }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  /* End sad statistics */

  /* Chemical statistics */
  var orders_chart_bar_chemical_type_ctx = document.getElementById("orders_chart_bar_chemical_type");
  var orders_chart_bar_chemical_manufacturer_ctx = document.getElementById("orders_chart_bar_chemical_manufacturer");
  var orders_chart_bar_chemical_type_chart;
  var orders_chart_bar_chemical_manufacturer_chart;

  orders_chart_bar_chemical_type_chart = new Chart(orders_chart_bar_chemical_type_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($orders_count_chemicals_types as $count){{ $count }},@endforeach],
        backgroundColor: '#00c0ef'
      }],
      labels: [@foreach($orders_count_chemicals_types as $type => $count)'{{ $type }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  orders_chart_bar_chemical_manufacturer_chart = new Chart(orders_chart_bar_chemical_manufacturer_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($orders_count_chemicals_manufacturers as $count){{ $count }},@endforeach],
        backgroundColor: '#00c0ef'
      }],
      labels: [@foreach($orders_count_chemicals_manufacturers as $manufacturer => $count)'{{ $manufacturer }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  /* End chemical statistics */

});
</script>
@endsection