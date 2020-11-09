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
{{--                    <div class="m-widget24">--}}
{{--                        <div class="m-widget24__item">--}}
{{--                            <h4 class="m-widget24__title">--}}
{{--                                Total Frofit--}}
{{--                            </h4>--}}
{{--                            <br>--}}
{{--                            <span class="m-widget24__desc">--}}
{{--                                All Customs Value--}}
{{--                            </span>--}}
{{--                            <span class="m-widget24__stats m--font-brand">--}}
{{--                                $18M--}}
{{--                            </span>--}}
{{--                            <div class="m--space-10"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-12 col-lg-6 col-xl-3">--}}

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
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-12 col-lg-6 col-xl-3">--}}
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
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-12 col-lg-6 col-xl-3">--}}
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
{{--                        </div>--}}
{{--                    </div>--}}
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
                                        Date - Messages
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
        </div>
    </div>
@endsection
@section('script')
    <script>
        var MorrisChartsDemo = {
            init: function() {
                new Morris.Line({
                    element: "message_chart_1",
                    data: [
                        {
                            date: "2020-11-5",
                            message: 2276,
                        },
                    ],
                    xkey: "date",
                    ykeys: ["message"],
                    labels: ["Messages"]
                }),
                new Morris.Line({
                    element: "message_chart_2",
                    data: [
                        {
                            date: "2020-11-5",
                            message: 2276,
                        },
                    ],
                    xkey: "date",
                    ykeys: ["message"],
                    labels: ["Messages"]
                })
            }
        };
        jQuery(document).ready(function() {
            MorrisChartsDemo.init()
        });
    </script>
@endsection
