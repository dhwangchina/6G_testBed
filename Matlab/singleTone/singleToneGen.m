%% ���ɵ����ź�:�������浥���ź�f(t)=A*cos2��*f0*t
clc;clear;
%% ϵͳ��������
T_start  = 0;                 % ���濪ʼʱ�䣺
T_stop   = 100;               % �������ʱ�䣺
T        = T_stop - T_start;  % �������ʱ�䣺
T_sample = 1/2^6;              % ���������
f_sample = 1/T_sample;        % �������ʣ�
N_sample = T/T_sample;        % ����������
f_res    = f_sample/N_sample; % Ƶ�ʷֱ��ʣ�

%% �����źŲ�������
A     = 10;% ����
f0    = 10;% Ƶ��
theta = 0; % ��ʼ��λ

%% �����źŲ����벨�λ���
n = 0:N_sample;
f = A*cos(2*pi*f0*n*T_sample + theta);

figure(1);
plot(n*T_sample,f);

%% Ƶ������
f_max = f_res*N_sample/2;%���Ƶ��
F     = abs(fft(f));
F_rearrange = [F(N_sample/2 + 1:N_sample-1),F(1:N_sample/2)];

plot((-N_sample/2 + 1:N_sample/2-1)*f_res,F_rearrange(1:N_sample - 1));
