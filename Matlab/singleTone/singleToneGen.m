%% 生成单音信号:用来仿真单音信号f(t)=A*cos2π*f0*t
clc;clear;
%% 系统参数配置
T_start  = 0;                 % 仿真开始时间：
T_stop   = 100;               % 仿真结束时间：
T        = T_stop - T_start;  % 仿真持续时间：
T_sample = 1/2^6;              % 采样间隔：
f_sample = 1/T_sample;        % 采样速率：
N_sample = T/T_sample;        % 采样点数：
f_res    = f_sample/N_sample; % 频率分辨率：

%% 单音信号参数配置
A     = 10;% 幅度
f0    = 10;% 频率
theta = 0; % 初始相位

%% 单音信号产生与波形绘制
n = 0:N_sample;
f = A*cos(2*pi*f0*n*T_sample + theta);

figure(1);
plot(n*T_sample,f);

%% 频谱特性
f_max = f_res*N_sample/2;%最大频率
F     = abs(fft(f));
F_rearrange = [F(N_sample/2 + 1:N_sample-1),F(1:N_sample/2)];

plot((-N_sample/2 + 1:N_sample/2-1)*f_res,F_rearrange(1:N_sample - 1));
