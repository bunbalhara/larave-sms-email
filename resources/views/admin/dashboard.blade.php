@extends('layouts.master')

@section('title', 'Admin Dashboard')
@section('style')

@endsection
@section('breadcrumb')
    <div class="mr-auto">
        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
            <li class="m-nav__item m-nav__item--home">
                <a href="" class="m-nav__link m-nav__link--icon">
                    <i class="m-nav__link-icon la la-home"></i>
                </a>
            </li>
            <li class="m-nav__separator">/</li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                    <span class="m-nav__link-text">Dashboard</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="tabs-wrapper">
        <ul class="tab-nav">
            <li class="tab-item"><a class="tab-link tab-active" data-area="#reports" href="#/reports"> Reports</a></li>
        </ul>
    </div>
    <div class="m-portlet m-portlet--mobile tab_area area-active" id="reports_area">
        <div class="m-portlet__body">

{{--            <div class="row m-row--no-padding m-row--col-separator-xl">--}}
{{--                <div class="col-md-12 col-lg-6 col-xl-3">--}}
{{--                    <!--begin::Total Profit-->--}}
{{--                    <div class="m-widget24">--}}
{{--                        <div class="m-widget24__item">--}}
{{--                            <h4 class="m-widget24__title">--}}
{{--                                Total SMS--}}
{{--                                --}}
{{--                            </h4>--}}
{{--                            <br>--}}
{{--                            <span class="m-widget24__desc">--}}
{{--                                All Customs Value--}}
{{--                            </span>--}}
{{--                            <span class="m-widget24__stats m--font-brand">--}}
{{--                                $18M--}}
{{--                            </span>--}}
{{--                            <div class="m--space-10"></div>--}}
{{--                            <div class="progress m-progress--sm">--}}
{{--                                <div class="progress-bar m--bg-brand" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                            <span class="m-widget24__change">--}}
{{--                                Change--}}
{{--                            </span>--}}
{{--                            <span class="m-widget24__number">--}}
{{--                                78%--}}
{{--                            </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!--end::Total Profit-->--}}
{{--                </div>--}}
{{--                <div class="col-md-12 col-lg-6 col-xl-3">--}}

{{--                    <!--begin::New Feedbacks-->--}}
{{--                    <div class="m-widget24">--}}
{{--                        <div class="m-widget24__item">--}}
{{--                            <h4 class="m-widget24__title">--}}
{{--                                New Feedbacks--}}
{{--                            </h4>--}}
{{--                            <br>--}}
{{--                            <span class="m-widget24__desc">--}}
{{--													Customer Review--}}
{{--												</span>--}}
{{--                            <span class="m-widget24__stats m--font-info">--}}
{{--													1349--}}
{{--												</span>--}}
{{--                            <div class="m--space-10"></div>--}}
{{--                            <div class="progress m-progress--sm">--}}
{{--                                <div class="progress-bar m--bg-info" role="progressbar" style="width: 84%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                            <span class="m-widget24__change">--}}
{{--													Change--}}
{{--												</span>--}}
{{--                            <span class="m-widget24__number">--}}
{{--													84%--}}
{{--												</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!--end::New Feedbacks-->--}}
{{--                </div>--}}
{{--                <div class="col-md-12 col-lg-6 col-xl-3">--}}

{{--                    <!--begin::New Orders-->--}}
{{--                    <div class="m-widget24">--}}
{{--                        <div class="m-widget24__item">--}}
{{--                            <h4 class="m-widget24__title">--}}
{{--                                New Orders--}}
{{--                            </h4>--}}
{{--                            <br>--}}
{{--                            <span class="m-widget24__desc">--}}
{{--													Fresh Order Amount--}}
{{--												</span>--}}
{{--                            <span class="m-widget24__stats m--font-danger">--}}
{{--													567--}}
{{--												</span>--}}
{{--                            <div class="m--space-10"></div>--}}
{{--                            <div class="progress m-progress--sm">--}}
{{--                                <div class="progress-bar m--bg-danger" role="progressbar" style="width: 69%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                            <span class="m-widget24__change">--}}
{{--													Change--}}
{{--												</span>--}}
{{--                            <span class="m-widget24__number">--}}
{{--													69%--}}
{{--												</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!--end::New Orders-->--}}
{{--                </div>--}}
{{--                <div class="col-md-12 col-lg-6 col-xl-3">--}}

{{--                    <!--begin::New Users-->--}}
{{--                    <div class="m-widget24">--}}
{{--                        <div class="m-widget24__item">--}}
{{--                            <h4 class="m-widget24__title">--}}
{{--                                New Users--}}
{{--                            </h4>--}}
{{--                            <br>--}}
{{--                            <span class="m-widget24__desc">--}}
{{--													Joined New User--}}
{{--												</span>--}}
{{--                            <span class="m-widget24__stats m--font-success">--}}
{{--													276--}}
{{--												</span>--}}
{{--                            <div class="m--space-10"></div>--}}
{{--                            <div class="progress m-progress--sm">--}}
{{--                                <div class="progress-bar m--bg-success" role="progressbar" style="width: 90%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                            <span class="m-widget24__change">--}}
{{--													Change--}}
{{--												</span>--}}
{{--                            <span class="m-widget24__number">--}}
{{--													90%--}}
{{--												</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!--end::New Users-->--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="m-portlet m-portlet--tab">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                    <h3 class="m-portlet__head-text">
                                        Daily Messages
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div id="message_chart_1" style="height:500px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="m-portlet m-portlet--tab">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                    <h3 class="m-portlet__head-text">
                                        Message - Recipients
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div id="message_chart_2" style="height:500px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="m-portlet m-portlet--tab">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Daily Emails
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div id="message_chart_3" style="height:500px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="m-portlet m-portlet--tab">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                    <h3 class="m-portlet__head-text">
                                        Email - Recipients
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div id="message_chart_4" style="height:500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                type:'get',
                url:'{{route("admin.dashboard.get-message-data")}}',
                success: res => {
                    console.log(res)
                    if(res.status){
                        let MorrisChartsDemo = {
                            init: function() {
                                new Morris.Line({
                                    element: "message_chart_1",
                                    data:res.data.data1,
                                    xkey: "date",
                                    ykeys: ["message"],
                                    labels: ["Messages"]
                                }),
                                new Morris.Line({
                                    element: "message_chart_2",
                                    data:res.data.data2,
                                    xkey: "date",
                                    ykeys: ["message"],
                                    labels: ["Messages"]
                                }),
                                new Morris.Line({
                                    element: "message_chart_3",
                                    data:res.data.data3,
                                    xkey: "date",
                                    ykeys: ["email"],
                                    labels: ["Emails"]
                                }),
                                new Morris.Line({
                                    element: "message_chart_4",
                                    data:res.data.data4,
                                    xkey: "date",
                                    ykeys: ["email"],
                                    labels: ["Emails"]
                                })
                            }
                        };
                        MorrisChartsDemo.init()
                    }
                }
            })
        });
    </script>
@endsection
