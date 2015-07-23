/////////////////////////addd back in
                <div class="row to_hide snd_div" style="display:none;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>First Blood</th>
                                <th>Planter</th>
                                <th>Site</th>
                                <th>Victor</th>
                                <th>Side Won</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i<=11; $i++)
                            <tr>
                                <td><h5 class="text">Round {!!$i!!}</h5></td>
                                <td>{!!Form::select('fb[]', ['' => 'Select'] + $match->rostera->players + $match->rosterb->players, [], ['class' => 'form-control'])!!}</td>
                                <td>{!!Form::select('planter[]', ['' => 'Select'] +  $match->teams, [], ['class' => 'form-control'])!!}</td>
                                <td>{!!Form::select('site[]', ['' => 'Select', 'a' => 'A', 'b' => 'B'], [], ['class' => 'form-control'])!!}</td>
                                <td>{!!Form::select('team[]', ['' => 'Select'] +  $match->teams, [], ['class' => 'form-control'])!!}</td>
                                <td>{!!Form::select('side[]', ['' => 'Select', 'o' => 'Offense', 'd' => 'Defense'], [], ['class' => 'form-control'])!!}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                </div>
