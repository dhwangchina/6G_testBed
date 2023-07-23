clear all;close all;clc;
%=======================================================
% generating a cos wave data with txt hex format
%=======================================================

fc          = 0.25e6 ;      % ����Ƶ��
fn          = 7.5e6 ;       % �Ӳ�Ƶ��
Fs          = 50e6 ;        % ����Ƶ��
T           = 1/fc ;        % �ź�����
Num         = Fs * T ;      % �������źŲ�������
t           = (0:Num-1)/Fs ;      % ��ɢʱ��
cosx        = cos(2*pi*fc*t) ;    % ����Ƶ�������ź�
cosn        = cos(2*pi*fn*t) ;    % �Ӳ��ź�
cosy        = mapminmax(cosx + cosn) ;     %��ֵ��չ����-1,1�� ֮��
cosy_dig    = floor((2^11-1) * cosy + 2^11) ;     %��ֵ��չ�� 0~4095
fid         = fopen('cosx0p25m7p5m12bit.txt', 'wt') ;  %д�����ļ�
fprintf(fid, '%x\n', cosy_dig) ;
fclose(fid) ;
 
%ʱ����
figure(1);
subplot(121);plot(t,cosx);hold on ;
plot(t,cosn) ;
subplot(122);plot(t,cosy_dig) ;
 
%Ƶ����
fft_cosy    = fftshift(fft(cosy, Num)) ;
f_axis      = (-Num/2 : Num/2 - 1) * (Fs/Num) ;
figure(5) ;
plot(f_axis, abs(fft_cosy)) ;