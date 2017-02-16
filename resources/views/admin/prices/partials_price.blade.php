<td><a href="{{ $price->url }}"><i class="uk-icon-check uk-text-success uk-animation-scale-down"></i> {{ $price->name }}</a></td>
<td>{{ $price->file }}</td>
<td>{{ $price->m_date->format('d-m-Y H:i') }} <span class="uk-text-muted uk-text-small">{{ $price->m_date->diffForHumans() }}</span></td>
<td>{{ $price->size }} Мб</td>