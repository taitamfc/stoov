@if ($template && !!$template->content)
	@php
		$templeteContent = html_entity_decode($template->content);
		$pattern = '/::(.*?)(?=(?:&lt;|$))/';
		preg_match_all($pattern, $template->content, $matches);
		$variables = $matches[1];
		$checkedAll = in_array('all', $variables);
		$fields = json_decode($data->content ?? '');
		$course = $data;
		if (!$checkedAll) {
			foreach ($variables as $variable) {
				switch ($variable) {
					case 'voornaam':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['first_name'], $templeteContent);
						break;
					case 'tussenvoegsel':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['midle_name'], $templeteContent);
						break;
					case 'achternaam':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['last_name'], $templeteContent);
						break;
					case 'amount_request':
						$templeteContent = str_replace('::' . $variable, getNumberFormat($course->amount_request ?? 0), $templeteContent);
						break;
					case 'id':
						$templeteContent = str_replace('::' . $variable, @$course->id, $templeteContent);
						break;
					case 'client_name':
						$templeteContent = str_replace('::' . $variable, @$course->user->full_name, $templeteContent);
						break;
					case 'organisatie':
						$templeteContent = str_replace('::' . $variable, @$course->client->company->organisatie, $templeteContent);
						break;
					case 'contact_no':
						$templeteContent = str_replace('::' . $variable, @$course->client->company->contact_no, $templeteContent);
						break;
					case 'website':
						$templeteContent = str_replace('::' . $variable, @$course->client->company->website, $templeteContent);
						break;
					case 'company_email':
						$templeteContent = str_replace('::' . $variable, @$course->client->company->email, $templeteContent);
						break;
					case 'naam_werknemer_voorletters':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][0]['first_name'], $templeteContent);
						break;
					case 'naam_werknemer_tussenvoegsel':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][0]['middle_name'], $templeteContent);
						break;
					case 'naam_werknemer_achternaammeisjesnaam':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][0]['last_name'], $templeteContent);
						break;
					case 'geboortedatum_werknemer':
						$fieldDates = @json_decode(@$data->content, true)['data_deelnemerslijst'][0];
						$stringDate = implode('-',[@$fieldDates['geboortedatum_werknemer_dd'], @$fieldDates['geboortedatum_werknemer_mm'], @$fieldDates['geboortedatum_werknemer_jjjj']]);
						$templeteContent = str_replace('::' . $variable, $stringDate, $templeteContent);
						break;
					case 'naam_werknemer_2_voorletters':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][1]['first_name'], $templeteContent);
						break;
					case 'naam_werknemer_2_tussenvoegsel':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][1]['middle_name'], $templeteContent);
						break;
					case 'naam_werknemer_2_achternaammeisjesnaam':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][1]['last_name'], $templeteContent);
						break;
					case 'geboortedatum_2_werknemer':
						$fieldDates = @json_decode(@$data->content, true)['data_deelnemerslijst'][1];
						$stringDate = implode('-',[@$fieldDates['geboortedatum_werknemer_dd'], @$fieldDates['geboortedatum_werknemer_mm'], @$fieldDates['geboortedatum_werknemer_jjjj']]);
						$templeteContent = str_replace('::' . $variable, $stringDate, $templeteContent);
						break;
					case 'naam_werknemer_3_voorletters':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][2]['first_name'], $templeteContent);
						break;
					case 'naam_werknemer_3_tussenvoegsel':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][2]['middle_name'], $templeteContent);
						break;
					case 'naam_werknemer_3_achternaammeisjesnaam':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][2]['last_name'], $templeteContent);
						break;
					case 'geboortedatum_3_werknemer':
						$fieldDates = @json_decode(@$data->content, true)['data_deelnemerslijst'][2];
						$stringDate = implode('-',[@$fieldDates['geboortedatum_werknemer_dd'], @$fieldDates['geboortedatum_werknemer_mm'], @$fieldDates['geboortedatum_werknemer_jjjj']]);
						$templeteContent = str_replace('::' . $variable, $stringDate, $templeteContent);
						break;
					case 'naam_werknemer_4_voorletters':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][3]['first_name'], $templeteContent);
						break;
					case 'naam_werknemer_4_tussenvoegsel':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][3]['middle_name'], $templeteContent);
						break;
					case 'naam_werknemer_4_achternaammeisjesnaam':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][3]['last_name'], $templeteContent);
						break;
					case 'geboortedatum_4_werknemer':
						$fieldDates = @json_decode(@$data->content, true)['data_deelnemerslijst'][3];
						$stringDate = implode('-',[@$fieldDates['geboortedatum_werknemer_dd'], @$fieldDates['geboortedatum_werknemer_mm'], @$fieldDates['geboortedatum_werknemer_jjjj']]);
						$templeteContent = str_replace('::' . $variable, $stringDate, $templeteContent);
						break;
					case 'naam_werknemer_5_voorletters':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][4]['first_name'], $templeteContent);
						break;
					case 'naam_werknemer_5_tussenvoegsel':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][4]['middle_name'], $templeteContent);
						break;
					case 'naam_werknemer_5_achternaammeisjesnaam':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][4]['last_name'], $templeteContent);
						break;
					case 'geboortedatum_5_werknemer':
						$fieldDates = @json_decode(@$data->content, true)['data_deelnemerslijst'][4];
						$stringDate = implode('-',[@$fieldDates['geboortedatum_werknemer_dd'], @$fieldDates['geboortedatum_werknemer_mm'], @$fieldDates['geboortedatum_werknemer_jjjj']]);
						$templeteContent = str_replace('::' . $variable, $stringDate, $templeteContent);
						break;
					case 'naam_werknemer_6_voorletters':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][5]['first_name'], $templeteContent);
						break;
					case 'naam_werknemer_6_tussenvoegsel':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][5]['middle_name'], $templeteContent);
						break;
					case 'naam_werknemer_6_achternaammeisjesnaam':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][5]['last_name'], $templeteContent);
						break;
					case 'geboortedatum_6_werknemer':
						$fieldDates = @json_decode(@$data->content, true)['data_deelnemerslijst'][5];
						$stringDate = implode('-',[@$fieldDates['geboortedatum_werknemer_dd'], @$fieldDates['geboortedatum_werknemer_mm'], @$fieldDates['geboortedatum_werknemer_jjjj']]);
						$templeteContent = str_replace('::' . $variable, $stringDate, $templeteContent);
						break;
					case 'naam_werknemer_7_voorletters':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][6]['first_name'], $templeteContent);
						break;
					case 'naam_werknemer_7_tussenvoegsel':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][6]['middle_name'], $templeteContent);
						break;
					case 'naam_werknemer_7_achternaammeisjesnaam':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][6]['last_name'], $templeteContent);
						break;
					case 'geboortedatum_7_werknemer':
						$fieldDates = @json_decode(@$data->content, true)['data_deelnemerslijst'][6];
						$stringDate = implode('-',[@$fieldDates['geboortedatum_werknemer_dd'], @$fieldDates['geboortedatum_werknemer_mm'], @$fieldDates['geboortedatum_werknemer_jjjj']]);
						$templeteContent = str_replace('::' . $variable, $stringDate, $templeteContent);
						break;
					case 'naam_werknemer_8_voorletters':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][7]['first_name'], $templeteContent);
						break;
					case 'naam_werknemer_8_tussenvoegsel':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][7]['middle_name'], $templeteContent);
						break;
					case 'naam_werknemer_8_achternaammeisjesnaam':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][7]['last_name'], $templeteContent);
						break;
					case 'geboortedatum_8_werknemer':
						$fieldDates = @json_decode(@$data->content, true)['data_deelnemerslijst'][7];
						$stringDate = implode('-',[@$fieldDates['geboortedatum_werknemer_dd'], @$fieldDates['geboortedatum_werknemer_mm'], @$fieldDates['geboortedatum_werknemer_jjjj']]);
						$templeteContent = str_replace('::' . $variable, $stringDate, $templeteContent);
						break;
					case 'naam_werknemer_9_voorletters':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][8]['first_name'], $templeteContent);
						break;
					case 'naam_werknemer_9_tussenvoegsel':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][8]['middle_name'], $templeteContent);
						break;
					case 'naam_werknemer_9_achternaammeisjesnaam':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][8]['last_name'], $templeteContent);
						break;
					case 'geboortedatum_9_werknemer':
						$fieldDates = @json_decode(@$data->content, true)['data_deelnemerslijst'][8];
						$stringDate = implode('-',[@$fieldDates['geboortedatum_werknemer_dd'], @$fieldDates['geboortedatum_werknemer_mm'], @$fieldDates['geboortedatum_werknemer_jjjj']]);
						$templeteContent = str_replace('::' . $variable, $stringDate, $templeteContent);
						break;
					case 'naam_werknemer_10_voorletters':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][9]['first_name'], $templeteContent);
						break;
					case 'naam_werknemer_10_tussenvoegsel':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][9]['middle_name'], $templeteContent);
						break;
					case 'naam_werknemer_10_achternaammeisjesnaam':
						$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)['data_deelnemerslijst'][9]['last_name'], $templeteContent);
						break;
					case 'geboortedatum_10_werknemer':
						$fieldDates = @json_decode(@$data->content, true)['data_deelnemerslijst'][9];
						$stringDate = implode('-',[@$fieldDates['geboortedatum_werknemer_dd'], @$fieldDates['geboortedatum_werknemer_mm'], @$fieldDates['geboortedatum_werknemer_jjjj']]);
						$templeteContent = str_replace('::' . $variable, $stringDate, $templeteContent);
						break;
					default:
						if (gettype(@json_decode($data->content, true)[$variable]) != 'array') {
							$templeteContent = str_replace('::' . $variable, @json_decode(@$data->content, true)[$variable], $templeteContent);
						} else {
							// $xml = '';
							// foreach (@json_decode($data->content, true)[$variable] as $arrayIndex => $arrayValue) {
							//     foreach ($arrayValue as $fieldArrayName => $fieldValue) {
							//         $xml .=
							//             '<p><label class="text-bold">' .
							//             __(ucfirst(str_replace('_', ' ', $fieldArrayName))) .
							//             ':</label>
							//         <span>' .
							//             $fieldValue .
							//             '</span></p>';
							//     }
							// }
							// $templeteContent = str_replace('::' . $variable, $xml, $templeteContent);
						}
						break;
				}
			}
		}

	@endphp
	@if ($checkedAll)
		<p>
			@foreach ($fields as $filedName => $fieldValue)
				@if (gettype($fieldValue) !== 'array')
					<p>
						<label class="text-bold">{{ gettype($filedName) == 'string' ? __(ucfirst(str_replace('_', ' ', $filedName))) : '' }}:</label>
						<span>{{ is_string($fieldValue) ? $fieldValue : '' }}</span>
					</p>
				@endif
			@endforeach
			@foreach ($fields as $filedName => $fieldValue)
				@if (gettype($fieldValue) === 'array')
					<p>
						@foreach ($fieldValue as $arrayIndex => $arrayValue)
							<label
								class="text-bold">{{ is_string($filedName) ? __(ucfirst(str_replace('_', ' ', $filedName))) : '' . ' ' . ($arrayIndex + 1) }}
							</label>
							<p>
								@foreach ($arrayValue as $fieldArrayName => $fieldValue)
									<p>
										<label
											class="text-bold">{{ __(ucfirst(str_replace('_', ' ', $fieldArrayName))) }}:</label>
										<span>{{ $fieldValue }}</span>
									</p>
								@endforeach
							</p>
						@endforeach
					</p>
				@endif
			@endforeach
		</p>
		<p>
			<label class="text-bold">{{ __('Amount Request') }}:</label>
			<span>{{ getNumberFormat($course->amount_request ?? 0) }}</span>
		</p>
		<h3>{{ __('Company Information') }}</h3>
		<p>
			<label class="text-bold">{{ __('Client name') }}:</label>
			<span>{{ $course->user->full_name ?? '' }}</span>
		</p>
		<p>
			<label class="text-bold">{{ __('Company name') }}:</label>
			<span>{{ $course->client->company->organisatie ?? '' }}</span>
		</p>
		<p>
			<label class="text-bold">{{ __('Company contact') }}:</label>
			<span>{{ $course->client->company->contact_no ?? '' }}</span>
		</p>
		<p>
			<label class="text-bold">{{ __('Company website') }}:</label>
			<span>{{ $course->client->company->website ?? '' }}</span>
		</p>
		<p>
			<label class="text-bold">{{ __('Company email') }}:</label>
			<span>{{ $course->client->company->email ?? '' }}</span>
		</p>
	@else
		{!! $templeteContent !!}
	@endif
@else
	{{ __('No content') }}
@endif

