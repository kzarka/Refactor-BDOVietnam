<li class="nav-title">System Utilization</li>
<li class="nav-item px-3 mb-3 d-compact-none d-minimized-none">
	<div class="text-uppercase mb-1">
		<small><b>SSD Usage</b></small>
	</div>
	@php
	$disk_info = FileHelper::getDiskInformations();
	$disk_status_class = 'bg-success';
	if($disk_info['used_percent'] >= 80) {
		$disk_status_class = 'bg-danger';
	} elseif ($disk_info['used_percent'] >= 50) {
		$disk_status_class = 'bg-warning';
	}
	@endphp
	<div class="progress progress-xs">
		<div class="progress-bar {{ $disk_status_class }}" role="progressbar" style="width: {{ $disk_info['used_percent'] }}%" aria-valuenow="{{ $disk_info['used_percent'] }}" aria-valuemin="0" aria-valuemax="100"></div>
	</div>
	<small class="text-muted">{{ $disk_info['used'] }}/{{ $disk_info['total'] }}</small>
</li>