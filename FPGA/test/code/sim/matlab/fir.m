clear all;close all;clc;
%=======================================================
% generating a cos wave data with txt hex format
%=======================================================

fc          = 0.25e6 ;      % 中心频率
fn          = 7.5e6 ;       % 杂波频率
Fs          = 50e6 ;        % 采样频率
T           = 1/fc ;        % 信号周期
Num         = Fs * T ;      % 周期内信号采样点数
t           = (0:Num-1)/Fs ;      % 离散时间
cosx        = cos(2*pi*fc*t) ;    % 中心频率正弦信号
cosn        = cos(2*pi*fn*t) ;    % 杂波信号
cosy        = mapminmax(cosx + cosn) ;     %幅值扩展到（-1,1） 之间
cosy_dig    = floor((2^11-1) * cosy + 2^11) ;     %幅值扩展到 0~4095
fid         = fopen('cosx0p25m7p5m12bit.txt', 'wt') ;  %写数据文件
fprintf(fid, '%x\n', cosy_dig) ;
fclose(fid) ;
 
%时域波形
figure(1);
subplot(121);plot(t,cosx);hold on ;
plot(t,cosn) ;
subplot(122);plot(t,cosy_dig) ;
 
%频域波形
fft_cosy    = fftshift(fft(cosy, Num)) ;
f_axis      = (-Num/2 : Num/2 - 1) * (Fs/Num) ;
figure(5) ;
plot(f_axis, abs(fft_cosy)) ;